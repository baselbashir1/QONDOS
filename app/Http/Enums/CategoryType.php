<?php

namespace App\Http\Enums;

enum CategoryType: string
{
    case mainCategory = 'تصنيف رئيسي';
    case subCategory = 'تصنيف فرعي';
    case service = 'خدمة';

    public static function getCategoryType()
    {
        return [
            self::mainCategory, self::subCategory, self::service
        ];
    }
}
