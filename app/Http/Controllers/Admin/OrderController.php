<?php

namespace App\Http\Controllers\Admin;

use App\Models\Offer;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Enums\OrderStatus;

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
        $offer = Offer::where('order_id', $order->id)->first();
        return view('pages.orders.details', ['order' => $order, 'offer' => $offer]);
    }

    public function edit(Order $order)
    {
        $offer = Offer::where('order_id', $order->id)->first();
        $orderStatuses = OrderStatus::getOrderStatus();
        return view('pages.orders.edit', ['order' => $order, 'offer' => $offer, 'orderStatuses' => $orderStatuses]);
    }

    public function update(Request $request, Order $order)
    {
        $formFields = $request->all();

        $order->update([
            'notes' => $formFields['notes'],
            'is_scheduled' => $formFields['is_scheduled'],
            'visit_time' => $formFields['visit_time'],
            'status' => $formFields['status'],
        ]);

        return redirect()->route('orders.index');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index');
    }
}
