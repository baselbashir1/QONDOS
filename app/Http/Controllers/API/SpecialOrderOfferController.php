<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpecialOrderOfferResource;
use App\Models\SpecialOrderOffer;

class SpecialOrderOfferController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $offers = SpecialOrderOffer::paginate(5);
        return SpecialOrderOfferResource::collection($offers);
    }

    public function show(SpecialOrderOffer $offer)
    {
        return SpecialOrderOfferResource::make($offer);
    }
}
