<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderImage extends Model
{
    use HasFactory;

    protected $table = 'order_has_images';
    protected $fillable = ['order_id', 'image'];
}
