<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Enums\CategoryType;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::paginate(5);
        return view('pages.services.list', ['services' => $services]);
    }

    public function show()
    {
    }

    public function create()
    {
        $subCategories = SubCategory::all();
        $categoryTypes = [CategoryType::mainCategory, CategoryType::subCategory, CategoryType::service];
        return view('pages.services.add', ['subCategories' => $subCategories, 'categoryTypes' => $categoryTypes]);
    }

    public function store(ServiceRequest $request)
    {
        $formFields = $request->validated();

        try {
            if ($request->hasFile('image')) {
                $formFields['image'] = $request->file('image')->store('images', 'public');
            }

            Service::create([
                'type' => $formFields['type'],
                'en' => [
                    'name' => $formFields['name_en']
                ],
                'ar' => [
                    'name' => $formFields['name_ar']
                ],
                'image' => isset($formFields['image']) ? $formFields['image'] : null,
                'sub_category_id' => $formFields['sub_category']
            ]);

            notify()->success('تمت إضافة الخدمة بنجاح');
            return redirect()->route('services.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء إضافة الخدمة');
        }
    }

    public function edit(Service $service)
    {
        $subCategories = SubCategory::all();
        $categoryTypes = [CategoryType::mainCategory, CategoryType::subCategory, CategoryType::service];
        return view('pages.services.edit', ['service' => $service, 'subCategories' => $subCategories, 'categoryTypes' => $categoryTypes]);
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $formFields = $request->validated();

        try {
            if ($request->hasFile('image')) {
                $formFields['image'] = $request->file('image')->store('images', 'public');
            }

            $service->update([
                'type' => $formFields['type'],
                'en' => [
                    'name' => $formFields['name_en']
                ],
                'ar' => [
                    'name' => $formFields['name_ar']
                ],
                'image' => isset($formFields['image']) ? $formFields['image'] : $service->image,
                'sub_category_id' => $formFields['sub_category']
            ]);

            notify()->success('تم تعديل الخدمة بنجاح');
            return redirect()->route('services.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء تعديل الخدمة');
        }
    }

    public function destroy(Service $service)
    {
        $service->delete();
        notify()->success('تم حذف الخدمة بنجاح');
        return redirect()->route('services.index');
    }
}
