<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\SpecialServiceOrderRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderImage;
use App\Models\OrderService;
use App\Models\ServiceRequest;
use App\Models\SpecialService;
use App\Models\SpecialServiceOrder;
use App\Models\SpecialServiceOrderImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index()
    {
        return ClientResource::collection(Client::all());
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
        $token = $client->token();
        return response()->json(['client' => $client, 'token' => $token]);
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
        ]);

        $services = $inputFields['services'] ?? [];
        if (!is_array($services)) {
            return response()->json(['error' => 'Invalid services.'], 400);
        }

        foreach ($services as $serviceId) {
            OrderService::create([
                'order_id' => $order->id,
                'service_id' => $serviceId,
            ]);
        }

        $imagesPaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imagePath = $imageFile->store('images', 'public');
                $imagesPaths[] = $imagePath;
            }
        }

        // dd($imagesPaths);

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

        // dd($specialServiceOrder, $imagesPaths);

        foreach ($imagesPaths as $imagePath) {
            SpecialServiceOrderImage::create([
                'order_id' => $specialServiceOrder->id,
                'image' => $imagePath
            ]);
        }

        return response()->json(['success' => 'Added request for special service order successfully.']);
    }
}
