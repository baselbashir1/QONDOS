<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Distance;
use Illuminate\Http\Request;

class DistanceController extends Controller
{
    public function setDistance(Request $request)
    {
        $inputFields = $request->validate([
            'distance' => ['required', 'numeric'],
            'is_current' => ['required', 'boolean']
        ]);

        $distance = Distance::where('is_current', true)->first();
        if ($distance) {
            $distance->update([
                'distance' => $inputFields['distance'],
                'is_current' => $inputFields['is_current']
            ]);
        } else {
            Distance::create([
                'distance' => $inputFields['distance'],
                'is_current' => $inputFields['is_current']
            ]);
        }

        return response()->json(['success' => 'Distance added successfully.']);
    }
}
