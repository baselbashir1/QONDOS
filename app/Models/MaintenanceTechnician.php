<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class MaintenanceTechnician extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'maintenance-technician';
    protected $fillable = ['name', 'email', 'phone', 'city', 'password'];
}
