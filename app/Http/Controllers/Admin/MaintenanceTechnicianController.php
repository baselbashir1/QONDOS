<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Service;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\MaintenanceTechnician;
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
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $services = Service::all();
        return view('pages.maintenance-technicians.add', ['categories' => $categories, 'subCategories' => $subCategories, 'services' => $services]);
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

            MaintenanceTechnician::create([
                'name' => $formFields['name'],
                'phone' => $formFields['phone'],
                'password' => bcrypt($formFields['password']),
                'city' => $formFields['city'],
                'bank' => $formFields['bank'],
                'account_number' => $formFields['account_number'],
                'photo' => isset($formFields['photo']) ? $formFields['photo'] : null,
                'residency_photo' => isset($formFields['residency_photo']) ? $formFields['residency_photo'] : null,
                'is_verified' => 1,
                'main_category_id' => $formFields['main_category'],
                'sub_category_id' => $formFields['sub_category'],
                'service_id' => $formFields['service'],
            ]);

            notify()->success('تمت إضافة فني صيانة بنجاح');
            return redirect()->route('maintenance-technicians.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء إضافة فني صيانة');
        }
    }

    public function edit(MaintenanceTechnician $maintenanceTechnician)
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $services = Service::all();
        return view('pages.maintenance-technicians.edit', [
            'maintenanceTechnician' => $maintenanceTechnician,
            'categories' => $categories,
            'subCategories' => $subCategories,
            'services' => $services
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
                'residency_photo' => isset($formFields['residency_photo']) ? $formFields['residency_photo'] : $maintenanceTechnician->residency_photo,
                'main_category_id' => $formFields['main_category'],
                'sub_category_id' => $formFields['sub_category'],
                'service_id' => $formFields['service']
            ]);

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
