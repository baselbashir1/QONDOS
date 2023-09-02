<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Service;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\MaintenanceTechnician;
use App\Models\MaintenanceSubCategory;
use App\Http\Requests\MaintenanceTechnicianRequest;

class MaintenanceTechnicianController extends Controller
{
    public function index()
    {
        $maintenanceTechnicians = MaintenanceTechnician::where('is_verified', 1)->paginate(5);
        return view('pages.maintenance-technicians.list', ['maintenanceTechnicians' => $maintenanceTechnicians]);
    }

    public function show(MaintenanceTechnician $maintenanceTechnician)
    {
        return view('pages.maintenance-technicians.details', ['maintenanceTechnician' => $maintenanceTechnician]);
    }

    public function create()
    {
        $subCategories = SubCategory::all();
        return view('pages.maintenance-technicians.add', ['subCategories' => $subCategories]);
    }

    public function store(MaintenanceTechnicianRequest $request)
    {
        $formFields = $request->validated();

        try {
            if ($request->hasFile('photo')) {
                $formFields['photo'] = $request->file('photo')->store('images', 'public');
            }

            if ($request->hasFile('residency_photo')) {
                $formFields['residency_photo'] = $request->file('residency_photo')->store('images', 'public');
            }

            $maintenanceTechnician =  MaintenanceTechnician::create([
                'name' => $formFields['name'],
                'phone' => $formFields['phone'],
                'password' => bcrypt($formFields['password']),
                'city' => $formFields['city'],
                'bank' => $formFields['bank'],
                'account_number' => $formFields['account_number'],
                'photo' => isset($formFields['photo']) ? $formFields['photo'] : null,
                'residency_photo' => isset($formFields['residency_photo']) ? $formFields['residency_photo'] : null,
                'is_verified' => 1,
                'latitude' => isset($formFields['latitude']) ? $formFields['latitude'] : null,
                'longitude' => isset($formFields['longitude']) ? $formFields['longitude'] : null,
            ]);

            $subCategories = $formFields['sub_categories'] ?? [];
            foreach ($subCategories as $subCategoryId) {
                MaintenanceSubCategory::create([
                    'maintenance_technician_id' => $maintenanceTechnician->id,
                    'sub_category_id' => $subCategoryId
                ]);
            }

            notify()->success('تمت إضافة فني صيانة بنجاح');
            return redirect()->route('maintenance-technicians.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء إضافة فني صيانة');
        }
    }

    public function edit(MaintenanceTechnician $maintenanceTechnician)
    {
        $selected = DB::table('maintenance_sub_categories')
            ->where('maintenance_sub_categories.maintenance_technician_id', $maintenanceTechnician->id)
            ->pluck('maintenance_sub_categories.sub_category_id', 'maintenance_sub_categories.sub_category_id')
            ->all();
        $subCategories = SubCategory::all();
        return view('pages.maintenance-technicians.edit', [
            'maintenanceTechnician' => $maintenanceTechnician,
            'subCategories' => $subCategories,
            'selected' => $selected
        ]);
    }

    public function update(MaintenanceTechnicianRequest $request, MaintenanceTechnician $maintenanceTechnician)
    {
        $formFields = $request->validated();

        try {
            if ($request->hasFile('photo')) {
                $formFields['photo'] = $request->file('photo')->store('images', 'public');
            }

            if ($request->hasFile('residency_photo')) {
                $formFields['residency_photo'] = $request->file('residency_photo')->store('images', 'public');
            }

            $maintenanceTechnician->update([
                'name' => $formFields['name'],
                'phone' => $formFields['phone'],
                'password' => bcrypt($formFields['password']),
                'city' => $formFields['city'],
                'bank' => $formFields['bank'],
                'account_number' => $formFields['account_number'],
                'photo' => isset($formFields['photo']) ? $formFields['photo'] : $maintenanceTechnician->photo,
                'residency_photo' => isset($formFields['residency_photo']) ? $formFields['residency_photo'] : $maintenanceTechnician->residency_photo
            ]);

            $subCategories = $formFields['sub_categories'] ?? [];
            foreach ($maintenanceTechnician->maintenanceSubCategories as $maintenanceSubCategory) {
                $matchingSubCategory = null;
                foreach ($subCategories as $subCategoryId) {
                    if ($maintenanceSubCategory->maintenance_technician_id == $maintenanceTechnician->id && $maintenanceSubCategory->sub_category_id == $subCategoryId) {
                        $matchingSubCategory = $subCategoryId;
                        break;
                    }
                }
                if ($matchingSubCategory !== null) {
                    $maintenanceSubCategory->update([
                        'sub_category_id' => $matchingSubCategory
                    ]);
                } else {
                    $maintenanceSubCategory->delete();
                }
            }

            foreach ($subCategories as $subCategoryId) {
                $existingSubCategory = $maintenanceTechnician->maintenanceSubCategories()
                    ->where('sub_category_id', $subCategoryId)
                    ->first();

                if (!$existingSubCategory) {
                    MaintenanceSubCategory::create([
                        'maintenance_technician_id' => $maintenanceTechnician->id,
                        'sub_category_id' => $subCategoryId
                    ]);
                }
            }

            notify()->success('تم تعديل فني الصيانة بنجاح');
            return redirect()->route('maintenance-technicians.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء تعديل فني الصيانة');
        }
    }

    public function destroy(MaintenanceTechnician $maintenanceTechnician)
    {
        $maintenanceTechnician->delete();
        notify()->success('تم حذف فني الصيانة بنجاح');
        return redirect()->route('maintenance-technicians.index');
    }

    public function joinRequests()
    {
        $maintenanceTechnicians = MaintenanceTechnician::where('is_verified', 0)->get();
        return view('pages.maintenance-technicians.join-requests', ['maintenanceTechnicians' => $maintenanceTechnicians]);
    }

    public function approve(MaintenanceTechnician $maintenanceTechnician)
    {
        $maintenanceTechnician->update(['is_verified' => 1]);
        notify()->success('تم قبول طلب انضمام فني الصيانة بنجاح');
        return redirect()->back();
    }

    public function reject(MaintenanceTechnician $maintenanceTechnician)
    {
        $maintenanceTechnician->delete();
        notify()->success('تم رفض فني الصيانة بنجاح');
        return redirect()->back();
    }

    public function getLocation()
    {
        $maintenanceTechnician = Auth::user();
        return response()->json([
            'latitude' => $maintenanceTechnician->latitude,
            'longitude' => $maintenanceTechnician->longitude,
        ]);
    }
}
