<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
        return view('pages.special-service-orders.details', ['specialServiceOrder' => $specialServiceOrder]);
    }

    public function edit(SpecialServiceOrder $specialServiceOrder)
    {
        return view('pages.special-service-orders.edit', ['specialServiceOrder' => $specialServiceOrder]);
    }

    public function update(Request $request, SpecialServiceOrder $specialServiceOrder)
    {
        $formFields = $request->all();

        $specialServiceOrder->update([
            'notes' => $formFields['notes'],
            'is_scheduled' => $formFields['is_scheduled'],
            'visit_time' => $formFields['visit_time'],
        ]);

        return redirect()->route('special-service-orders.index');
    }

    public function destroy(SpecialServiceOrder $specialServiceOrder)
    {
        $specialServiceOrder->delete();
        return redirect()->route('special-service-orders.index');
    }
}
