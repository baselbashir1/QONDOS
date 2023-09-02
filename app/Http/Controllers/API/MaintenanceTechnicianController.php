<?php

namespace App\Http\Controllers\API;

use App\Models\Offer;
use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\ClientAddress;
use App\Http\Enums\OfferStatus;
use App\Http\Enums\OrderStatus;
use App\Http\Traits\GeneralTrait;
use App\Models\SpecialOrderOffer;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OfferRequest;
use App\Models\SpecialServiceOrder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderResource;
use App\Models\MaintenanceTechnician;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\SpecialOrderOfferRequest;
use App\Http\Requests\MaintenanceTechnicianRequest;
use App\Http\Resources\MaintenanceTechnicianResource;
use App\Models\MaintenanceSubCategory;
use App\Models\OrderService;
use PhpParser\Node\Stmt\Foreach_;

class MaintenanceTechnicianController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $maintenanceTechnicians = MaintenanceTechnician::paginate(5);
        return MaintenanceTechnicianResource::collection($maintenanceTechnicians);
    }

    public function login(AuthRequest $request)
    {
        $inputFields = $request->all();

        $validator = Validator::make($inputFields, $request->rules());
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if (Auth::guard('maintenance-technician')->attempt(['phone' => $inputFields['phone'], 'password' => $inputFields['password'], 'is_verified' => 1])) {
            $maintenanceTechnician = Auth::guard('maintenance-technician')->user();

            $token = $maintenanceTechnician->createToken('maintenance-technician token', ['maintenance-technician'])->accessToken;

            return response()->json(['maintenance-technician' => $maintenanceTechnician, 'token' => $token]);
        } elseif (Auth::guard('maintenance-technician')->attempt(['phone' => $inputFields['phone'], 'password' => $inputFields['password'], 'is_verified' => 0])) {
            return response()->json(['unauthorized' => 'Pending approval.']);
        } else {
            return response()->json(['error' => 'Invalid Credentials']);
        }
    }

    public function register(MaintenanceTechnicianRequest $request)
    {
        $inputFields = $request->all();

        $validator = Validator::make($inputFields, $request->rules());
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $existingMaintenance = MaintenanceTechnician::where('phone', $inputFields['phone'])->first();
        if ($existingMaintenance) {
            return response()->json(['error' => 'Phone number already registered.']);
        }

        if ($request->hasFile('photo')) {
            $inputFields['photo'] = $request->file('photo')->store('images', 'public');
        }

        if ($request->hasFile('residency_photo')) {
            $inputFields['residency_photo'] = $request->file('residency_photo')->store('images', 'public');
        }

        $maintenanceTechnician = MaintenanceTechnician::create([
            'name' => $inputFields['name'],
            'phone' => $inputFields['phone'],
            'password' => bcrypt($inputFields['password']),
            'city' => $inputFields['city'],
            'bank' => $inputFields['bank'],
            'account_number' => $inputFields['account_number'],
            'photo' => isset($inputFields['photo']) ? $inputFields['photo'] : null,
            'residency_photo' => isset($inputFields['residency_photo']) ? $inputFields['residency_photo'] : null,
            'is_verified' => 0,
            'latitude' =>  $inputFields['latitude'],
            'longitude' =>  $inputFields['longitude'],
        ]);

        $subCategories = $inputFields['sub_categories'] ?? [];
        if (!is_array($subCategories)) {
            return response()->json(['error' => 'Invalid sub-categories.'], 400);
        }

        foreach ($subCategories as $subCategoryId) {
            MaintenanceSubCategory::create([
                'maintenance_technician_id' => $maintenanceTechnician->id,
                'sub_category_id' => $subCategoryId
            ]);
        }

        if (Auth::guard('maintenance-technician')->attempt(['phone' => $inputFields['phone'], 'password' => $inputFields['password']])) {
            return response()->json(['unauthorized' => 'Pending approval.']);
        } else {
            return response()->json(['error' => 'Registration failed to log in.']);
        }
    }

    public function getProfile()
    {
        $maintenanceTechnician = Auth::user();
        // $token = $maintenanceTechnician->token();
        return response()->json(['maintenanceTechnician' => $maintenanceTechnician]);
    }

    public function updateProfile(MaintenanceTechnicianRequest $request)
    {
        $inputFields = $request->validated();
        $maintenanceTechnician = Auth::user();

        if ($request->hasFile('photo')) {
            $inputFields['photo'] = $request->file('photo')->store('images', 'public');
        }

        if ($request->hasFile('residency_photo')) {
            $inputFields['residency_photo'] = $request->file('residency_photo')->store('images', 'public');
        }

        $maintenanceTechnician->update([
            'name' => $inputFields['name'],
            'phone' => $inputFields['phone'],
            'password' => bcrypt($inputFields['password']),
            'city' => $inputFields['city'],
            'bank' => $inputFields['bank'],
            'account_number' => $inputFields['account_number'],
            'photo' => $inputFields['photo'],
            'residency_photo' => $inputFields['residency_photo'],
            'latitude' => $inputFields['latitude'],
            'longitude' => $inputFields['longitude'],
        ]);

        $subCategories = $inputFields['sub_categories'] ?? [];
        if (!is_array($subCategories)) {
            return response()->json(['error' => 'Invalid sub-categories.'], 400);
        }

        foreach ($maintenanceTechnician->maintenanceSubCategories as $maintenanceSubCategory) {
            $matchingSubCategory = null;
            foreach ($subCategories as $subCategoryId) {
                if ($maintenanceSubCategory->maintenance_technician_id == $maintenanceTechnician->id && $maintenanceSubCategory->sub_category_id == $subCategoryId) {
                    $matchingSubCategory = $subCategoryId;
                    break;
                }
            }
            if ($matchingSubCategory !== null) {
                $maintenanceSubCategory->update([
                    'sub_category_id' => $matchingSubCategory
                ]);
            } else {
                $maintenanceSubCategory->delete();
            }
        }

        foreach ($subCategories as $subCategoryId) {
            $existingSubCategory = $maintenanceTechnician->maintenanceSubCategories()
                ->where('sub_category_id', $subCategoryId)
                ->first();

            if (!$existingSubCategory) {
                MaintenanceSubCategory::create([
                    'maintenance_technician_id' => $maintenanceTechnician->id,
                    'sub_category_id' => $subCategoryId
                ]);
            }
        }

        return response()->json(['success' => 'Maintenance updated successfully.', 'maintenance-technician' => $maintenanceTechnician]);
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

    public function showOrders()
    {
        $maintenanceTechnician = Auth::user();
        $clientAddresses = ClientAddress::where('is_current', 1)->get();
        $closestOrders = [];

        foreach ($clientAddresses as $clientAddress) {
            $distance = $this->calculateDistance($maintenanceTechnician->latitude, $maintenanceTechnician->longitude, $clientAddress->latitude, $clientAddress->longitude);
            if ($distance <= 500) {
                $orders = DB::table('orders')
                    ->join('client_addresses', 'orders.client_id', '=', 'client_addresses.client_id')
                    ->join('order_has_services', 'orders.id', '=', 'order_has_services.order_id')
                    ->join('services', 'order_has_services.service_id', '=', 'services.id')
                    ->join('maintenance_sub_categories', 'services.sub_category_id', '=', 'maintenance_sub_categories.sub_category_id')
                    ->where('client_addresses.is_current', 1)
                    ->select(['orders.id', 'orders.notes', 'orders.client_id', 'orders.is_scheduled', 'orders.visit_time', 'orders.payment_type', 'orders.payment_method', 'orders.status', 'order_has_services.service_id', 'order_has_services.quantity', 'orders.created_at', 'orders.updated_at'])
                    ->get();
                $closestOrders[] = ['order' => $orders, 'distance' => $distance . 'm'];
            }
        }

        return response()->json(['closest-orders' => $closestOrders]);
    }

    public function sendOffer(OfferRequest $request, Order $order)
    {
        $inputFields = $request->validated();
        $maintenanceTechnician = Auth::user();

        Offer::create([
            'description' => $inputFields['description'],
            'status' => OfferStatus::pending,
            'maintenance_technician_id' => $maintenanceTechnician->id,
            'client_id' => $order->client_id,
            'order_id' => $order->id
        ]);

        $order->update(['status' => OrderStatus::pendingClientApprove]);

        return response()->json(['success' => 'Offer sent successfully.']);
    }

    public function sendOfferToSpecialOrder(SpecialOrderOfferRequest $request, SpecialServiceOrder $specialServiceOrder)
    {
        $inputFields = $request->validated();
        $maintenanceTechnician = Auth::user();

        SpecialOrderOffer::create([
            'description' => $inputFields['description'],
            'status' => OfferStatus::pending,
            'maintenance_technician_id' => $maintenanceTechnician->id,
            'client_id' => $specialServiceOrder->client_id,
            'special_service_order_id' => $specialServiceOrder->id
        ]);

        $specialServiceOrder->update(['status' => OrderStatus::pendingClientApprove]);

        return response()->json(['success' => 'Offer sent successfully.']);
    }

    public function updateOfferAndOrderStatus(Request $request)
    {
        $action = $request->input('action');
        $offer_id = $request->input('offer_id');
        $order_id = $request->input('order_id');
        $specialOrderOffer_id = $request->input('special_order_offer_id');
        $specialServiceOrder_id = $request->input('special_service_order_id');

        $offer = Offer::find($offer_id);
        $order = Order::find($order_id);
        $specialOrderOffer = SpecialOrderOffer::find($specialOrderOffer_id);
        $specialServiceOrder = SpecialServiceOrder::find($specialServiceOrder_id);

        if ($action === 'confirmOffer' && $offer) {
            $offer->update([
                'status' => OfferStatus::confirmed
            ]);
            if ($offer->order) {
                $offer->order->update([
                    'status' => OrderStatus::processing
                ]);
            }
            return response()->json(['success' => 'Offer confirmed successfully.']);
        } elseif ($action === 'confirmOffer' && $specialOrderOffer) {
            $specialOrderOffer->update([
                'status' => OfferStatus::confirmed
            ]);
            if ($specialOrderOffer->order) {
                $specialOrderOffer->order->update([
                    'status' => OrderStatus::processing
                ]);
            }
            return response()->json(['success' => 'Offer confirmed successfully.']);
        } elseif ($action === 'requestFinishOrder' && $order) {
            $order->update([
                'status' => OrderStatus::pendingClientApproveFinish
            ]);
            return response()->json(['success' => 'Request to finish order sent successfully.']);
        } elseif ($action === 'requestFinishOrder' && $specialOrderOffer) {
            $specialServiceOrder->update([
                'status' => OrderStatus::pendingClientApproveFinish
            ]);
            return response()->json(['success' => 'Request to finish order sent successfully.']);
        } else {
            return response()->json(['error' => 'Invalid action or missing parameters.'], 400);
        }
    }
}
