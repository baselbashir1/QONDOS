<?php

namespace App\Http\Enums;

enum OrderStatus: string
{
    case canceled = 'Canceled';

    public static function getCategoryType()
    {
        return [
            self::canceled
        ];
    }
}
