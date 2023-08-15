<?php

namespace App\Http\Controllers;

use App\Http\Enums\CategoryType;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceTranslation;
use App\Models\SubCategory;
use App\Models\SubCategoryTranslation;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::all();
        return view('pages.sub-categories.list', ['subCategories' => $subCategories]);
    }

    public function show()
    {
    }

    public function create()
    {
        $categories = Category::all();
        $categoryTypes = [CategoryType::mainCategory, CategoryType::subCategory, CategoryType::service];
        return view('pages.sub-categories.add', ['categories' => $categories, 'categoryTypes' => $categoryTypes]);
    }

    public function store(SubCategoryRequest $request)
    {
        $formFields = $request->validated();

        try {
            if ($request->hasFile('image')) {
                $formFields['image'] = $request->file('image')->store('images', 'public');
            }

            SubCategory::create([
                'type' => $formFields['type'],
                'en' => [
                    'name' => $formFields['name_en']
                ],
                'ar' => [
                    'name' => $formFields['name_ar']
                ],
                'image' => isset($formFields['image']) ? $formFields['image'] : null,
                'category_id' => $formFields['category']
            ]);

            notify()->success('تمت إضافة التصنيف بنجاح');
            return redirect()->route('sub-categories.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء إضافة التصنيف');
        }
    }

    public function edit(SubCategory $subCategory)
    {
        $categories = Category::all();
        $categoryTypes = [CategoryType::mainCategory, CategoryType::subCategory, CategoryType::service];
        return view('pages.sub-categories.edit', ['subCategory' => $subCategory, 'categories' => $categories, 'categoryTypes' => $categoryTypes]);
    }

    public function update(SubCategoryRequest $request, SubCategory $subCategory)
    {
        $formFields = $request->validated();

        try {
            if ($request->hasFile('image')) {
                $formFields['image'] = $request->file('image')->store('images', 'public');
            }

            $subCategory->update([
                'type' => $formFields['type'],
                'en' => [
                    'name' => $formFields['name_en']
                ],
                'ar' => [
                    'name' => $formFields['name_ar']
                ],
                'image' => isset($formFields['image']) ? $formFields['image'] : $subCategory->image,
                'category_id' => $formFields['category']
            ]);

            notify()->success('تم تعديل التصنيف بنجاح');
            return redirect()->route('sub-categories.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء تعديل التصنيف');
        }
    }

    public function destroy(SubCategory $subCategory)
    {
        $subCategory->services()->delete();
        $subCategory->subCategoryTranslations()->delete();
        $subCategory->delete();
        notify()->success('تم حذف التصنيف بنجاح');
        return redirect()->route('sub-categories.index');
    }
}
