<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Models\SubCategory;
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
        return view('pages.sub-categories.add');
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
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء إضافة التصنيف');
            // return redirect()->back()->withErrors(['error' => 'حدث خطأ أثناء إضافة التصنيف']);
        }
    }

    public function edit(SubCategory $subCategory)
    {
        return view('pages.sub-categories.edit', ['subCategory' => $subCategory]);
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
                'image' => isset($formFields['image']) ? $formFields['image'] : $category->image,
                'category_id' => $formFields['category']
            ]);

            notify()->success('تم تعديل التصنيف بنجاح');
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء تعديل التصنيف');
            // return redirect()->back()->withErrors(['error' => 'حدث خطأ أثناء تعديل التصنيف']);
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();
        notify()->success('تم حذف التصنيف بنجاح');
        return redirect()->route('categories.index');
    }
}
