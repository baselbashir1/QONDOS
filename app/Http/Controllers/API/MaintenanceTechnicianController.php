<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\MaintenanceTechnicianRequest;
use App\Http\Resources\MaintenanceTechnicianResource;
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

        $newClient = new MaintenanceTechnician();
        $newClient->name = $inputFields['name'];
        $newClient->phone = $inputFields['phone'];
        $newClient->password = bcrypt($inputFields['password']);
        $newClient->city = $inputFields['city'];
        $newClient->bank = $inputFields['bank'];
        $newClient->account_number = $inputFields['account_number'];
        $newClient->photo =  isset($inputFields['photo']) ? $inputFields['photo'] : null;
        $newClient->residency_photo =  isset($inputFields['residency_photo']) ? $inputFields['residency_photo'] : null;
        $newClient->main_category_id = $inputFields['main_category'];
        $newClient->sub_category_id = $inputFields['sub_category'];
        $newClient->service_id = $inputFields['service'];
        $newClient->is_verified = 0;
        $newClient->save();

        // if ($newClient->save()) {
        if (Auth::guard('maintenance-technician')->attempt(['phone' => $inputFields['phone'], 'password' => $inputFields['password']])) {
            // $maintenanceTechnician = Auth::guard('maintenance-technician')->user();

            // $token = $maintenanceTechnician->createToken('maintenance-technician token', ['maintenance-technician'])->accessToken;

            return response()->json(['unauthorized' => 'Pending approval.']);
            // return response()->json(['maintenance-technician' => $maintenanceTechnician, 'token' => $token]);
        } else {
            return response()->json(['error' => 'Registration failed to log in.']);
        }
        // } else {
        //     return response()->json(['error' => 'Registration failed.']);
        // }
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
