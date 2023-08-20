<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::paginate(5);
        return ServiceResource::collection($services);
    }

    public function show(Service $service)
    {
        return ServiceResource::make($service);
    }
}
