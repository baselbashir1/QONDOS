<?php

namespace App\Http\Controllers\Admin;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;

class OfferController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $offers = Offer::paginate(5);
        return view('pages.offers.list', ['offers' => $offers]);
    }

    public function show(Offer $offer)
    {
        $clientLatitude = $offer->client->latitude;
        $clientLongitude = $offer->client->longitude;
        $maintenanceLatitude = $offer->maintenanceTechnician->latitude;
        $maintenanceLongitude = $offer->maintenanceTechnician->longitude;
        $distance = $this->calculateDistance($clientLatitude, $clientLongitude, $maintenanceLatitude, $maintenanceLongitude);
        return view('pages.offers.details', ['offer' => $offer, 'distance' => $distance]);
    }
}
