<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

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
        return view('pages.categories.add');
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
        return view('pages.categories.edit', ['category' => $category]);
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
