<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialServiceOrderImage extends Model
{
    use HasFactory;

    protected $table = ['special_service_order_images'];
    protected $fillable = ['special_service_order_id', 'image'];
}
