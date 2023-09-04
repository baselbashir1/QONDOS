<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Client;
use App\Models\Service;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\MaintenanceTechnician;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $subCategories = SubCategory::all();
        $categories = Category::all();
        $clients = Client::all();
        $maintenances = MaintenanceTechnician::all();
        $maintenancesJoinRequests = MaintenanceTechnician::where('is_verified', 0)->get();

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
            'maintenancesJoinRequests' => $maintenancesJoinRequests,
            'finished' => $finished,
            'processing' => $processing,
            'canceled' => $canceled,
            'other' => $other,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function clear()
    {
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        return 'cleared';
    }

    public function getSubCategory($id)
    {
        $service = Service::findOrFail($id);
        return (string) $service->subCategory->id;
    }

    public function getMainCategory($id)
    {
        $service = Service::findOrFail($id);
        return (string) $service->subCategory->category->id;
    }

    // public function settings()
    // {
    //     // return view('name', $data)->render();
    //     $distance = Distance::where('is_current', 1)->first();
    //     return view('pages.settings.index', ['distance' => $distance]);
    // }
}
