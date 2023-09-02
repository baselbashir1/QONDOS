<?php

namespace App\Http\Controllers\Admin;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Enums\OrderStatus;
use App\Models\SpecialServiceOrder;
use App\Http\Controllers\Controller;

class SpecialServiceOrderController extends Controller
{
    public function index()
    {
        $specialServiceOrders = SpecialServiceOrder::paginate(5);
        return view('pages.special-service-orders.list', ['specialServiceOrders' => $specialServiceOrders]);
    }

    public function show(SpecialServiceOrder $specialServiceOrder)
    {
        $offer = Offer::where('order_id', $specialServiceOrder->id)->first();
        return view('pages.special-service-orders.details', ['specialServiceOrder' => $specialServiceOrder, 'offer' => $offer]);
    }

    public function edit(SpecialServiceOrder $specialServiceOrder)
    {
        $orderStatuses = OrderStatus::getOrderStatus();
        return view('pages.special-service-orders.edit', ['specialServiceOrder' => $specialServiceOrder, 'orderStatuses' => $orderStatuses]);
    }

    public function update(Request $request, SpecialServiceOrder $specialServiceOrder)
    {
        $formFields = $request->all();

        try {
            $specialServiceOrder->update([
                'notes' => $formFields['notes'],
                'is_scheduled' => $formFields['is_scheduled'],
                'visit_time' => $formFields['visit_time'],
                'status' => $formFields['status'],
            ]);

            notify()->success('تم تحديث الطلب بنجاح');
            return redirect()->route('special-service-orders.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء تحديث الطلب');
        }
    }

    public function destroy(SpecialServiceOrder $specialServiceOrder)
    {
        $specialServiceOrder->delete();
        return redirect()->route('special-service-orders.index');
    }
}
