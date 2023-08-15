<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // protected $fillable = ['service_id', 'notes', 'image', 'client_id'];
    protected $fillable = ['notes', 'image', 'client_id'];
}