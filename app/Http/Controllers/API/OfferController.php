<?php

namespace App\Http\Controllers\API;

use App\Models\Offer;
use Illuminate\Http\Request;
use Doctrine\DBAL\Schema\Index;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;

class OfferController extends Controller
{
    use GeneralTrait;

    public function index()
    {
    }

    public function show(Offer $offer)
    {
        $lat1 = $offer->maintenanceTechnician->latitude;
        $lat2 = $offer->client->latitude;
        $long1 = $offer->maintenanceTechnician->longitude;
        $long2 = $offer->client->longitude;

        $distance =  $this->calculateDistance($lat1, $long1, $lat2, $long2);
        return response()->json(['offer' => $offer, 'distance' => $distance . 'm']);
    }
}
