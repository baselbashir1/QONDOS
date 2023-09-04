<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Enums\OrderStatus;
use App\Models\Client;
use App\Models\MaintenanceTechnician;
use App\Models\Order;
use App\Models\User;

class ChartController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();
        $clients = Client::all();
        $maintenances = MaintenanceTechnician::all();

        $orders = Order::all();
        $finished = Order::where('status', OrderStatus::finished)->get();
        $processing = Order::where('status', OrderStatus::processing)->get();
        $canceled = Order::where('status', OrderStatus::canceled)->get();
        $other = Order::whereIn('status', [OrderStatus::newOrder, OrderStatus::pendingClientApprove, OrderStatus::pendingClientApproveFinish, OrderStatus::pendingMaintenanceConfirm])->get();

        $totalPrice = 0.0;
        foreach ($orders as $order) {
            foreach ($order->orderServices as $orderService) {
                $totalPrice += $orderService->service->price * $orderService->quantity;
            }
        }

        return view('dashboard', [
            'services' => $services,
            'subCategories' => $subCategories,
            'categories' => $categories,
            'clients' => $clients,
            'maintenances' => $maintenances,
            'finished' => $finished,
            'processing' => $processing,
            'canceled' => $canceled,
            'other' => $other,
            'totalPrice' => $totalPrice
        ]);
    }
}
