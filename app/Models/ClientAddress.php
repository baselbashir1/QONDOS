<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientAddress extends Model
{
    use HasFactory;

    protected $fillable = ['home', 'address', 'longitude', 'latitude', 'client_id', 'is_current'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
