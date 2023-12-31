<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Enums\CategoryType;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(5);
        return view('pages.categories.list', ['categories' => $categories]);
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
                'type' => CategoryType::mainCategory,
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
                'type' => CategoryType::mainCategory,
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
        $category->delete();
        notify()->success('تم حذف التصنيف بنجاح');
        return redirect()->route('categories.index');
    }
}
