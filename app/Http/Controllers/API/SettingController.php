<?php

namespace App\Http\Controllers\API;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{

    public function updateSettings(SettingRequest $request)
    {
        $formFields = $request->validated();

        $settings = Setting::find(1);

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

        return response()->json(['success' => 'Settings updated successfully.']);
    }
}
