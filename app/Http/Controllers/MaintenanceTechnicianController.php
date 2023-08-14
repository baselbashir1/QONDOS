<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaintenanceTechnician;
use App\Http\Requests\MaintenanceTechnicianRequest;
use Exception;

class MaintenanceTechnicianController extends Controller
{
    public function index()
    {
        $maintenanceTechnicians = MaintenanceTechnician::all();
        return view('pages.maintenance-technicians.list', ['maintenanceTechnicians' => $maintenanceTechnicians]);
    }

    public function create()
    {
        return view('pages.maintenance-technicians.add');
    }

    public function store(MaintenanceTechnicianRequest $request)
    {
        $formFields = $request->validated();

        try {
            MaintenanceTechnician::create([
                'name' => $formFields['name'],
                'email' => isset($formFields['email']) ? $formFields['email'] : null,
                'phone' => $formFields['phone'],
                'city' => $formFields['city'],
                'password' => bcrypt($formFields['password'])
            ]);

            notify()->success('تمت إضافة فني صيانة بنجاح');
            return redirect()->route('maintenance-technicians.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء إضافة فني صيانة');
            // return redirect()->back()->withErrors(['error' => 'حدث خطأ أثناء إضافة فني صيانة']);
        }
    }

    public function edit(MaintenanceTechnician $maintenanceTechnician)
    {
        return view('pages.maintenance-technicians.edit', ['maintenanceTechnician' => $maintenanceTechnician]);
    }

    public function update(MaintenanceTechnicianRequest $request, MaintenanceTechnician $maintenanceTechnician)
    {
        $formFields = $request->validated();

        try {
            $maintenanceTechnician->update([
                'name' => $formFields['name'],
                'email' => isset($formFields['email']) ? $formFields['email'] : null,
                'phone' => $formFields['phone'],
                'city' => $formFields['city'],
                'password' => bcrypt($formFields['password'])
            ]);

            notify()->success('تم تعديل فني الصيانة بنجاح');
            return redirect()->route('maintenance-technicians.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء تعديل فني الصيانة');
            // return redirect()->back()->withErrors(['error' => 'حدث خطأ أثناء تعديل فني الصيانة']);
        }
    }

    public function destroy(MaintenanceTechnician $maintenanceTechnician)
    {
        $maintenanceTechnician->delete();
        notify()->success('تم حذف فني الصيانة بنجاح');
        return redirect()->route('maintenance-technicians.index');
    }
}
