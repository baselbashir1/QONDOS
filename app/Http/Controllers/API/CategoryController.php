<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(5);
        return CategoryResource::collection($categories);
    }

    public function show(Category $category)
    {
        $subCategories = $category->subCategories()->get();
        return [
            'category' => CategoryResource::make($category),
            'sub-categories' => SubCategoryResource::collection($subCategories),
        ];
    }
}
