<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::find(1);
        return view('pages.settings.index', ['settings' => $settings]);
    }

    public function updateSettings(SettingRequest $request)
    {
        $formFields = $request->validated();
        $settings = Setting::find(1);

        try {
            if ($settings) {
                $settings->update([
                    'distance' => $formFields['distance'],
                    'about' => $formFields['about'],
                    'privacy_policy' => $formFields['privacy_policy'],
                    'terms_and_conditions' => $formFields['terms_and_conditions']
                ]);
            } else {
                Setting::create([
                    'distance' => $formFields['distance'],
                    'about' => $formFields['about'],
                    'privacy_policy' => $formFields['privacy_policy'],
                    'terms_and_conditions' => $formFields['terms_and_conditions']
                ]);
            }

            notify()->success('تم تحديث الاعدادات بنجاح');
            return redirect()->back();
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء تحديث الاعدادات');
        }
    }
}
