<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(5);
        // $orders->orderServices->sum('price');
        // dd($orders->orderServices->sum('price'));
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
            'visit_time' => $formFields['visit_time'],
        ]);

        return redirect()->route('orders.index');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index');
    }
}
