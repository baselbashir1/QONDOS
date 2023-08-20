<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderImage;
use App\Models\OrderService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(5);
        return view('pages.orders.list', ['orders' => $orders]);
    }

    public function show(Order $order)
    {
        return view('pages.orders.details', ['order' => $order]);
    }

    public function edit(Order $order)
    {
        return view('pages.orders.edit', ['order' => $order]);
    }

    public function update(Request $request, Order $order)
    {
        $formFields = $request->all();

        $order->update([
            'notes' => $formFields['notes'],
            'is_scheduled' => $formFields['is_scheduled'],
            'visit_time' => isset($formFields['visit_time']) ? $formFields['visit_time'] : $order->visit_time
        ]);

        return redirect()->route('orders.index');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index');
    }
}
