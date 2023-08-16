<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
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
        $input = $request->validated();


        $order = Order::create([
            'notes' => $input['notes'],
            'client_id' => Auth::user()->id
        ]);

        $services = $input['services'] ?? [];
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

        // $images = $input['images'] ?? [];
        // if (!is_array($images)) {
        //     return response()->json(['error' => 'Invalid images.'], 400);
        // }

        // foreach ($images as $imageId) {
        //     OrderImage::create([
        //         'order_id' => $order->id,
        //         'image' => $imageId,
        //     ]);
        // }

        return response()->json(['success' => 'Added services and images to order successfully.']);
    }
}
