<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['notes', 'image', 'client_id', 'is_scheduled', 'visit_time'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function orderServices()
    {
        return $this->hasMany(OrderService::class, 'order_id');
    }

    public function orderImages()
    {
        return $this->hasMany(OrderImage::class, 'order_id');
    }
}
