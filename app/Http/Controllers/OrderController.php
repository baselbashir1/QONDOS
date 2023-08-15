<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderService;
use App\Models\Service;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('pages.orders.list', ['orders' => $orders]);
    }

    public function show(Order $order)
    {

        return view('pages.orders.details', ['order' => $order]);
    }
}
