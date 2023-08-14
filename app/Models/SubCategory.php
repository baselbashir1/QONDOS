<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class SubCategory extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['type', 'image', 'category_id'];
    public $translatedAttributes = ['name'];
}
