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
            'payment_type' => $formFields['payment_type'],
            'payment_method' => $order->payment_type === 1 ? $formFields['payment_method'] : null,
            'is_scheduled' => $formFields['is_scheduled'],
            'visit_time' => $formFields['visit_time'],
            'status' => $formFields['status'],
        ]);

        $quantities = $formFields['quantities'] ?? [];
        if (!is_array($quantities)) {
            notify()->error('حدث خطأ أثناء تعديل الطلب');
        }

        foreach ($order->orderServices as $orderService) {
            $quantity = $quantities[$orderService->id] ?? 1;
            $quantity = max(1, intval($quantity));
            $orderService->update([
                'quantity' => $quantity
            ]);
        }

        return redirect()->route('orders.index');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index');
    }
}
