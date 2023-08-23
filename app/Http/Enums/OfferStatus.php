<?php

namespace App\Http\Enums;

enum OfferStatus: string
{
    case pending = 'Pending';
    case accepted = 'Accepted';
    case rejected = 'Rejected';

    public static function getCategoryType()
    {
        return [
            self::pending, self::accepted, self::rejected
        ];
    }
}
