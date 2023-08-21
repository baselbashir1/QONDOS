<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialServiceOrder extends Model
{
    use HasFactory;

    protected $table = 'special_service_orders';
    protected $fillable = ['is_scheduled', 'visit_time', 'notes', 'client_id'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function orderImages(): HasMany
    {
        return $this->hasMany(SpecialServiceOrderImage::class, 'order_id');
    }
}
