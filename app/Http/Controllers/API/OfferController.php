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
        $offers = Offer::paginate(5);
        return OfferResource::collection($offers);
    }

    public function show(Offer $offer)
    {
        return OfferResource::make($offer);
    }
}
