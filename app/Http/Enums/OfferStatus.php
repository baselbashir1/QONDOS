<?php

namespace App\Http\Enums;

enum OfferStatus: string
{
    case pending = 'Pending';
    case accepted = 'Accepted';
    case rejected = 'Rejected';
    case confirmed = 'Confirmed';

    public static function getOfferStatus()
    {
        return [
            self::pending, self::accepted, self::rejected, self::confirmed
        ];
    }
}
