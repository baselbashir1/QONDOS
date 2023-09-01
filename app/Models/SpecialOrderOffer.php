<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialOrderOffer extends Model
{
    use HasFactory;

    protected $table = 'special_order_offers';
    protected $fillable = ['description', 'status', 'maintenance_technician_id', 'client_id', 'special_service_order_id'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(SpecialServiceOrder::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function maintenanceTechnician(): BelongsTo
    {
        return $this->belongsTo(MaintenanceTechnician::class);
    }
}
