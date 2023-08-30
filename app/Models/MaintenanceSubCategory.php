<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceSubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['maintenance_technician_id', 'sub_category_id'];

    public function maintenanceTechnician(): BelongsTo
    {
        return $this->belongsTo(MaintenanceTechnician::class);
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }
}
