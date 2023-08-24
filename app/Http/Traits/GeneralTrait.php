<?php

namespace App\Http\Traits;

trait GeneralTrait
{
    public function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $radius = 6371000;

        $lat1Rad = deg2rad($lat1);
        $lon1Rad = deg2rad($lon1);
        $lat2Rad = deg2rad($lat2);
        $lon2Rad = deg2rad($lon2);

        $dLat = $lat2Rad - $lat1Rad;
        $dLon = $lon2Rad - $lon1Rad;

        $a = sin($dLat / 2) * sin($dLat / 2) + cos($lat1Rad) * cos($lat2Rad) * sin($dLon / 2) * sin($dLon / 2);
        $b = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $radius * $b;
        return $distance;
    }
}
