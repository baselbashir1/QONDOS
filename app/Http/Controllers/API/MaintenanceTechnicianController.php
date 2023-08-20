<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\MaintenanceTechnicianRequest;
use App\Http\Resources\MaintenanceTechnicianResource;
use App\Models\Location;
use App\Models\MaintenanceTechnician;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MaintenanceTechnicianController extends Controller
{
    public function index()
    {
        return MaintenanceTechnicianResource::collection(MaintenanceTechnician::all());
    }

    public function login(AuthRequest $request)
    {
        $inputFields = $request->all();

        $validator = Validator::make($inputFields, $request->rules());
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if (Auth::guard('maintenance-technician')->attempt(['phone' => $inputFields['phone'], 'password' => $inputFields['password'], 'is_verified' => 1])) {
            $maintenanceTechnician = Auth::guard('maintenance-technician')->user();

            $token = $maintenanceTechnician->createToken('maintenance-technician token', ['maintenance-technician'])->accessToken;

            return response()->json(['maintenance-technician' => $maintenanceTechnician, 'token' => $token]);
        } elseif (Auth::guard('maintenance-technician')->attempt(['phone' => $inputFields['phone'], 'password' => $inputFields['password'], 'is_verified' => 0])) {
            return response()->json(['unauthorized' => 'Pending approval.']);
        } else {
            return response()->json(['error' => 'Invalid Credentials']);
        }
    }

    public function register(MaintenanceTechnicianRequest $request)
    {
        $inputFields = $request->all();

        $validator = Validator::make($inputFields, $request->rules());
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $existingClient = MaintenanceTechnician::where('phone', $inputFields['phone'])->first();
        if ($existingClient) {
            return response()->json(['error' => 'Phone number already registered.']);
        }

        if ($request->hasFile('photo')) {
            $inputFields['photo'] = $request->file('photo')->store('images', 'public');
        }

        if ($request->hasFile('residency_photo')) {
            $inputFields['residency_photo'] = $request->file('residency_photo')->store('images', 'public');
        }

        $location = Location::create([
            'latitude' =>  $inputFields['latitude'],
            'longitude' =>  $inputFields['longitude'],
        ]);

        MaintenanceTechnician::create([
            'name' => $inputFields['name'],
            'phone' => $inputFields['phone'],
            'password' => bcrypt($inputFields['password']),
            'city' => $inputFields['city'],
            'bank' => $inputFields['bank'],
            'account_number' => $inputFields['account_number'],
            'photo' => isset($inputFields['photo']) ? $inputFields['photo'] : null,
            'residency_photo' => isset($inputFields['residency_photo']) ? $inputFields['residency_photo'] : null,
            'main_category_id' => $inputFields['main_category'],
            'sub_category_id' => $inputFields['sub_category'],
            'service_id' => $inputFields['service'],
            'is_verified' => 0,
            'location_id' => $location->id
        ]);
        if (Auth::guard('maintenance-technician')->attempt(['phone' => $inputFields['phone'], 'password' => $inputFields['password']])) {
            return response()->json(['unauthorized' => 'Pending approval.']);
        } else {
            return response()->json(['error' => 'Registration failed to log in.']);
        }
    }

    public function getProfile()
    {
        $maintenanceTechnician = Auth::user();
        $token = $maintenanceTechnician->token();
        return response()->json(['maintenanceTechnician' => $maintenanceTechnician, 'token' => $token]);
    }

    public function logout()
    {
        $token = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $token->id)
            ->update([
                'revoked' => true
            ]);

        $token->revoke();
        return response()->json(['success' => 'Logged out successfully.', 'token' => $token]);
    }
}
