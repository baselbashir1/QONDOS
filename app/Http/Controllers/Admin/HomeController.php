<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Distance;
use App\Models\Service;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
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
