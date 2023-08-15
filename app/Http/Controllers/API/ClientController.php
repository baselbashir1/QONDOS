<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderImage;
use App\Models\OrderService;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index()
    {
        return ClientResource::collection(Client::all());
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $rules = [
            'phone' => 'required',
            'password' => 'required|min:6'
        ];

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if (Auth::guard('client')->attempt(['phone' => $input['phone'], 'password' => $input['password']])) {
            $client = Auth::guard('client')->user();

            $token = $client->createToken('client token', ['client'])->accessToken;

            return response()->json(['client' => $client, 'token' => $token]);
        } else {
            return response()->json(['error' => 'Invalid Credentials']);
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

    // public function makeOrder(OrderRequest $request, Service $service)
    // public function makeOrder(OrderRequest $request)
    // {
    //     $input = $request->validated();

    //     // if ($request->hasFile('image')) {
    //     //     $formFields['image'] = $request->file('image')->store('images', 'public');
    //     // }
    //     $order = Order::create([
    //         // 'service_id' => $service->id,
    //         'notes' => $input['notes'],
    //         'image' => isset($input['image']) ? $input['image'] : null,
    //         'client_id' => Auth::user()->id
    //     ]);

    //     $services = $request->input('services', []);
    //     if (!is_array($services)) {
    //         return response()->json(['error' => 'Invalid checkbox values format'], 400);
    //     }
    //     // $services = $request->input('services');
    //     foreach ($services as $ser) {
    //         OrderService::create([
    //             'order_id' => $order->id,
    //             'service_id' => $ser,
    //         ]);
    //     }

    //     return response()->json(['success' => 'Added services to order successfully.']);
    // }

    // public function makeOrder(Request $request)
    // {
    //     $input = $request->all();
    //     $rules = [
    //         'services' => 'required',
    //         'notes' => 'nullable',
    //         'images' => 'nullable|array|max:5',
    //         'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ];
    //     $validator = Validator::make($input, $rules);
    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()]);
    //     }

    //     $order = Order::create([
    //         'notes' => $input['notes'],
    //         'client_id' => Auth::user()->id
    //     ]);

    //     $imagesPaths = [];
    //     if ($request->hasFile('images')) {
    //         foreach ($request->file('images') as $imageFile) {
    //             $imagePath = $imageFile->store('images', 'public');
    //             $imagesPaths[] = $imagePath;
    //         }
    //     }

    //     foreach ($imagesPaths as $imagePath) {
    //         OrderImage::create([
    //             'order_id' => $order->id,
    //             'image' => $imagePath,
    //         ]);
    //     }

    //     $services = $input['services'] ?? [];
    //     if (!is_array($services)) {
    //         return response()->json(['error' => 'Invalid input'], 400);
    //     }

    //     foreach ($services as $serviceId) {
    //         OrderService::create([
    //             'order_id' => $order->id,
    //             'service_id' => $serviceId,
    //         ]);
    //     }

    //     return response()->json(['success' => 'Added services and images to order successfully.']);
    // }

    public function makeOrder(OrderRequest $request)
    {
        $input = $request->validated();

        $imagesPaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imagePath = $imageFile->store('images', 'public');
                $imagesPaths[] = $imagePath;
            }
        }

        $order = Order::create([
            'notes' => $input['notes'],
            'client_id' => Auth::user()->id
        ]);

        foreach ($imagesPaths as $imagePath) {
            OrderImage::create([
                'order_id' => $order->id,
                'image' => $imagePath,
            ]);
        }

        $services = $input['services'] ?? [];
        if (!is_array($services)) {
            return response()->json(['error' => 'Invalid checkbox values format'], 400);
        }

        foreach ($services as $serviceId) {
            OrderService::create([
                'order_id' => $order->id,
                'service_id' => $serviceId,
            ]);
        }

        return response()->json(['success' => 'Added services and images to order successfully.']);
    }
}
