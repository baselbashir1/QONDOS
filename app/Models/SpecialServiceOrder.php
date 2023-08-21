<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialServiceOrder extends Model
{
    use HasFactory;

    protected $table = 'special_service_orders';
    protected $fillable = ['is_scheduled', 'visit_time', 'notes', 'client_id'];


    public function specialServiceOrderImages()
    {
        return $this->hasMany(SpecialServiceOrderImage::class, 'special_service_order_id');
    }
}
