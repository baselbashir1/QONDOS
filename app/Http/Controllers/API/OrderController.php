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
        $orders = Order::paginate(5);
        return OrderResource::collection($orders);
    }

    public function show(Order $order)
    {
        return OrderResource::make($order);
    }
}
