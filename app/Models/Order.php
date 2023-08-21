<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['notes', 'client_id', 'is_scheduled', 'visit_time', 'payment_type', 'payment_method'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function orderServices(): HasMany
    {
        return $this->hasMany(OrderService::class, 'order_id');
    }

    public function orderImages(): HasMany
    {
        return $this->hasMany(OrderImage::class, 'order_id');
    }

    public function specialServices(): HasMany
    {
        return $this->hasMany(SpecialService::class, 'order_id');
    }
}
