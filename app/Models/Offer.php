<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'status', 'maintenance_technician_id', 'client_id', 'order_id'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
