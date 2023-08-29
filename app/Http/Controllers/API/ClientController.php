<?php

namespace App\Http\Controllers\API;

use App\Models\Offer;
use App\Models\Order;
use App\Models\Client;
use App\Models\Rating;
use App\Models\OrderImage;
use App\Models\OrderService;
use Illuminate\Http\Request;
use App\Models\ClientAddress;
use App\Http\Enums\OfferStatus;
use App\Http\Enums\OrderStatus;
use App\Http\Traits\GeneralTrait;
use App\Models\SpecialOrderOffer;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Models\SpecialServiceOrder;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OfferResource;
use App\Models\MaintenanceTechnician;
use App\Http\Resources\ClientResource;
use App\Models\SpecialServiceOrderImage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ClientAddressRequest;
use App\Http\Resources\ClientAddressResource;
use App\Http\Requests\SpecialServiceOrderRequest;

class ClientController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $clients = Client::paginate(5);
        return ClientResource::collection($clients);
    }

    public function login(AuthRequest $request)
    {
        $inputFields = $request->all();

        $validator = Validator::make($inputFields, $request->rules());
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if (Auth::guard('client')->attempt(['phone' => $inputFields['phone'], 'password' => $inputFields['password']])) {
            $client = Auth::guard('client')->user();

            $token = $client->createToken('client token', ['client'])->accessToken;

            return response()->json(['client' => $client, 'token' => $token]);
        } else {
            return response()->json(['error' => 'Invalid Credentials']);
        }
    }

    public function register(ClientRequest $request)
    {
        $inputFields = $request->all();

        $validator = Validator::make($inputFields, $request->rules());
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $existingClient = Client::where('phone', $inputFields['phone'])->first();
        if ($existingClient) {
            return response()->json(['error' => 'Phone number already registered.']);
        }

        $newClient = Client::create([
            'name' => $inputFields['name'],
            'phone' => $inputFields['phone'],
            'email' => isset($inputFields['email']) ? $inputFields['email'] : null,
            'city' => $inputFields['city'],
            'password' => bcrypt($inputFields['password'])
        ]);

        if ($newClient) {
            if (Auth::guard('client')->attempt(['phone' => $inputFields['phone'], 'password' => $inputFields['password']])) {
                $client = Auth::guard('client')->user();

                $token = $client->createToken('client token', ['client'])->accessToken;

                return response()->json(['client' => $client, 'token' => $token]);
            } else {
                return response()->json(['error' => 'Registration failed to log in.']);
            }
        } else {
            return response()->json(['error' => 'Registration failed.']);
        }
    }

    public function getProfile()
    {
        $client = Auth::user();
        $clientAddresses = $client->addresses()->get();
        $token = $client->token();
        return response()->json(['client' => $client, 'addresses' => $clientAddresses, 'token' => $token]);
    }

    public function logout()
    {
        $token = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $token->id)
            ->update([
                'revoked' => true
            ]);

        $token->revoke();
        return response()->json(['success' => 'Logged out successfully.', 'token' => $token]);
    }

    public function makeOrder(OrderRequest $request)
    {
        $inputFields = $request->validated();

        $order = Order::create([
            'notes' => $inputFields['notes'],
            'client_id' => Auth::user()->id,
            'is_scheduled' => $inputFields['is_scheduled'],
            'visit_time' => isset($inputFields['visit_time']) ? $inputFields['visit_time'] : null,
            'payment_type' => $inputFields['payment_type'],
            'payment_method' => isset($inputFields['payment_method']) ? $inputFields['payment_method'] : null,
            'status' => OrderStatus::newOrder
        ]);

        $order->payment_type ? $order->update(['payment_method' => $order->payment_method]) : $order->update(['payment_method' => null]);

        $services = $inputFields['services'] ?? [];
        if (!is_array($services)) {
            return response()->json(['error' => 'Invalid services.'], 400);
        }

        foreach ($services as $serviceId => $serviceQuantity) {
            $quantity = $serviceQuantity['quantity'] ?? 1;
            $quantity = max(1, intval($quantity));
            OrderService::create([
                'order_id' => $order->id,
                'service_id' => $serviceId,
                'quantity' => $quantity
            ]);
        }

        $imagesPaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imagePath = $imageFile->store('images', 'public');
                $imagesPaths[] = $imagePath;
            }
        }

        foreach ($imagesPaths as $imagePath) {
            OrderImage::create([
                'order_id' => $order->id,
                'image' => $imagePath,
            ]);
        }

        return response()->json(['success' => 'Added services and images to order successfully.']);
    }

    public function requestSpecialService(SpecialServiceOrderRequest $request)
    {
        $inputFields = $request->validated();

        $specialServiceOrder = SpecialServiceOrder::create([
            'notes' => $inputFields['notes'],
            'client_id' => Auth::user()->id,
            'is_scheduled' => $inputFields['is_scheduled'],
            'visit_time' => isset($inputFields['visit_time']) ? $inputFields['visit_time'] : null
        ]);

        $imagesPaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imagePath = $imageFile->store('images', 'public');
                $imagesPaths[] = $imagePath;
            }
        }

        foreach ($imagesPaths as $imagePath) {
            SpecialServiceOrderImage::create([
                'special_service_order_id' => $specialServiceOrder->id,
                'image' => $imagePath
            ]);
        }

        return response()->json(['success' => 'Added request for special service order successfully.']);
    }

    public function setLocation(ClientAddressRequest $request)
    {
        $client = Auth::user();
        $inputFields = $request->validated();

        $addresses = $inputFields['addresses'] ?? [];
        if (!is_array($addresses)) {
            return response()->json(['error' => 'Invalid addresses.'], 400);
        }

        $clientAddresses = ClientAddress::where(['client_id' => $client->id, 'is_current' => 1])->get();
        foreach ($clientAddresses as $clientAddress) {
            $clientAddress->update(['is_current' => 0]);
        }

        foreach ($addresses as $address) {
            ClientAddress::create([
                'home' => $inputFields['home'],
                'longitude' => $inputFields['longitude'],
                'latitude' => $inputFields['latitude'],
                'address' => $address,
                'client_id' => $client->id,
                'is_current' => 1
            ]);
        }

        return response()->json(['success' => 'Client updated successfully.']);
    }

    public function getLocations()
    {
        $client = Auth::user();
        $clientAddresses = $client->addresses()->paginate(5);
        return ClientAddressResource::collection($clientAddresses);
    }

    public function chooseLocation(ClientAddress $clientAddress)
    {
        $client = Auth::user();

        $clientAddresses = ClientAddress::where(['client_id' => $client->id, 'is_current' => 1])->get();
        foreach ($clientAddresses as $address) {
            $address->update(['is_current' => 0]);
        }

        $clientAddress->update(['is_current' => 1]);

        return response()->json(['success' => 'Client location updated successfully.']);
    }

    public function showOrderOffers(Order $order)
    {
        $offers = Offer::where(['order_id' => $order->id, 'status' => OfferStatus::pending])->paginate(5);
        return OfferResource::collection($offers);
    }

    public function updateOfferAndOrderStatus(Offer $offer = null, Order $order = null, SpecialOrderOffer $specialOrderOffer = null, SpecialServiceOrder $specialServiceOrder = null, $action = null)
    {
        if ($action === 'acceptOffer' && $offer) {
            $offer->update([
                'status' => OfferStatus::accepted
            ]);
            if ($offer->order) {
                $offer->order->update([
                    'status' => OrderStatus::pendingMaintenanceConfirm
                ]);
            }
            return response()->json(['success' => 'Offer accepted successfully.']);
        } elseif ($action === 'acceptOffer' && $specialOrderOffer) {
            $specialOrderOffer->update([
                'status' => OfferStatus::accepted
            ]);
            if ($specialOrderOffer->order) {
                $specialOrderOffer->order->update([
                    'status' => OrderStatus::pendingMaintenanceConfirm
                ]);
            }
            return response()->json(['success' => 'Offer accepted successfully.']);
        } elseif ($action === 'rejectOffer' && $specialOrderOffer) {
            $specialOrderOffer->update([
                'status' => OfferStatus::rejected
            ]);
            return response()->json(['success' => 'Offer rejected successfully.']);
        } elseif ($action === 'cancelOrder' && $specialServiceOrder) {
            $specialServiceOrder->update([
                'status' => OrderStatus::canceled
            ]);
            return response()->json(['success' => 'Order canceled successfully.']);
        } elseif ($action === 'acceptFinishOrder' && $specialServiceOrder) {
            $specialServiceOrder->update([
                'status' => OrderStatus::finished
            ]);
            return response()->json(['success' => 'Approved finish order successfully.']);
        } else {
            return response()->json(['error' => 'Invalid action or missing parameters.'], 400);
        }
    }

    public function evaluateMaintenance(Request $request, MaintenanceTechnician $maintenanceTechnician)
    {
        $inputFields = $request->validate([
            'rate' => 'required|numeric|min:0.5|max:5'
        ]);

        Rating::create([
            'rate' => $inputFields['rate'],
            'maintenance_technician_id' => $maintenanceTechnician->id
        ]);

        return response()->json(['success' => 'Maintenance evaluated successfully.']);
    }

    public function updateProfile(Request $request)
    {
        $inputFields = $request->all();
        $client = Auth::user();
        $client->update($inputFields);
        return response()->json(['success' => 'Client updated successfully.', 'client' => $client]);
    }
}
