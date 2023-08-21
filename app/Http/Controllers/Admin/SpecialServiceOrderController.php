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
}
