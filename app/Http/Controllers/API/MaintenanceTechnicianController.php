<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MaintenanceTechnicianController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->all();
        $rules = [
            'phone' => 'required',
            'password' => 'required|min:6'
        ];

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if (Auth::guard('maintenance-technician')->attempt(['phone' => $input['phone'], 'password' => $input['password']])) {
            $maintenanceTechnician = Auth::guard('maintenance-technician')->user();

            $token = $maintenanceTechnician->createToken('maintenance-technician token', ['maintenance-technician'])->accessToken;

            return response()->json(['maintenance-technician' => $maintenanceTechnician, 'token' => $token]);
        } else {
            return response()->json(['error' => 'Invalid Credentials']);
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
