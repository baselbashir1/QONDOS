<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MaintenanceTechnician extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'maintenance-technician';
    protected $fillable = ['name', 'phone', 'password', 'city', 'bank', 'account_number', 'photo', 'residency_photo', 'is_verified', 'latitude', 'longitude'];

    // public function mainCategory(): BelongsTo
    // {
    //     return $this->belongsTo(Category::class);
    // }

    // public function subCategory(): BelongsTo
    // {
    //     return $this->belongsTo(SubCategory::class);
    // }

    // public function service(): BelongsTo
    // {
    //     return $this->belongsTo(Service::class);
    // }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'maintenance_technician_id');
    }

    // public function subCategories(): HasMany
    // {
    //     return $this->hasMany(SubCategory::class);
    // }

    public function maintenanceSubCategories(): HasMany
    {
        return $this->hasMany(MaintenanceSubCategory::class, 'maintenance_technician_id');
    }
}
