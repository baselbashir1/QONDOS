<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['rate', 'maintenance_technician_id'];

    public function maintenanceTechnician(): BelongsTo
    {
        return $this->belongsTo(MaintenanceTechnician::class);
    }
}
