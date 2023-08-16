<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderImagesResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderServicesResource;
use App\Models\Order;
use App\Models\OrderImage;
use App\Models\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return OrderResource::collection(Order::all());
    }

    public function show(Order $order)
    {
        $orderServices = OrderService::where('order_id', $order->id)->get();
        $orderImages = OrderImage::where('order_id', $order->id)->get();
        return [
            'order' => OrderResource::make($order),
            'order-services' => OrderServicesResource::collection($orderServices),
            'order-images' => OrderImagesResource::collection($orderImages)
        ];
    }
}
