<?php

namespace App\Http\Controllers\API;

use App\Models\Offer;
use Illuminate\Http\Request;
use Doctrine\DBAL\Schema\Index;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OfferResource;

class OfferController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $client = Auth::user();
        $offers = DB::table('offers')
            ->join('orders', 'orders.client_id', '=', 'offers.client_id')
            ->where('offers.client_id', $client->id)
            ->get();

        return OfferResource::collection($offers);
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
