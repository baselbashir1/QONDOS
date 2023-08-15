<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Enums\CategoryType;
use App\Models\CategoryTranslation;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('pages.categories.list', ['categories' => $categories]);
    }

    public function show()
    {
    }

    public function create()
    {
        $categoryTypes = [CategoryType::mainCategory, CategoryType::subCategory, CategoryType::service];
        return view('pages.categories.add', ['categoryTypes' => $categoryTypes]);
    }

    public function store(CategoryRequest $request)
    {
        $formFields = $request->validated();

        try {
            if ($request->hasFile('image')) {
                $formFields['image'] = $request->file('image')->store('images', 'public');
            }

            Category::create([
                'type' => $formFields['type'],
                'en' => [
                    'name' => $formFields['name_en']
                ],
                'ar' => [
                    'name' => $formFields['name_ar']
                ],
                'image' => isset($formFields['image']) ? $formFields['image'] : null
            ]);

            notify()->success('تمت إضافة التصنيف بنجاح');
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء إضافة التصنيف');
            // return redirect()->back()->withErrors(['error' => 'حدث خطأ أثناء إضافة التصنيف']);
        }
    }

    public function edit(Category $category)
    {
        $categoryTypes = [CategoryType::mainCategory, CategoryType::subCategory, CategoryType::service];
        return view('pages.categories.edit', ['category' => $category, 'categoryTypes' => $categoryTypes]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $formFields = $request->validated();

        try {
            if ($request->hasFile('image')) {
                $formFields['image'] = $request->file('image')->store('images', 'public');
            }

            $category->update([
                'type' => $formFields['type'],
                'en' => [
                    'name' => $formFields['name_en']
                ],
                'ar' => [
                    'name' => $formFields['name_ar']
                ],
                'image' => isset($formFields['image']) ? $formFields['image'] : $category->image
            ]);

            notify()->success('تم تعديل التصنيف بنجاح');
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء تعديل التصنيف');
        }
    }

    public function destroy(Category $category)
    {
        $category->subCategories()->delete();
        $category->categoryTranslations()->delete();
        $category->delete();
        notify()->success('تم حذف التصنيف بنجاح');
        return redirect()->route('categories.index');
    }
}
