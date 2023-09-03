<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Models\SpecialOrderOffer;

class SpecialOrderOfferController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $specialOrderOffers = SpecialOrderOffer::paginate(5);
        return view('pages.special-order-offers.list', ['specialOrderOffers' => $specialOrderOffers]);
    }

    public function show(SpecialOrderOffer $specialOrderOffer)
    {
        $clientLatitude = $specialOrderOffer->client->latitude;
        $clientLongitude = $specialOrderOffer->client->longitude;
        $maintenanceLatitude = $specialOrderOffer->maintenanceTechnician->latitude;
        $maintenanceLongitude = $specialOrderOffer->maintenanceTechnician->longitude;
        $distance = $this->calculateDistance($clientLatitude, $clientLongitude, $maintenanceLatitude, $maintenanceLongitude);
        return view('pages.special-order-offers.details', ['specialOrderOffer' => $specialOrderOffer, 'distance' => $distance]);
    }
}
