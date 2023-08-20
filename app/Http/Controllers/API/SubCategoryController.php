<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\Service;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::paginate(5);
        return SubCategoryResource::collection($subCategories);
    }

    public function show(SubCategory $subCategory)
    {
        $services = $subCategory->services()->get();
        return [
            'sub-category' => SubCategoryResource::make($subCategory),
            'services' => ServiceResource::collection($services)
        ];
    }
}
