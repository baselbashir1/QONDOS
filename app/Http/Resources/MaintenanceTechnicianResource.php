<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaintenanceTechnicianResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'password' => $this->password,
            'city' => $this->city,
            'bank' => $this->bank,
            'account_number' => $this->account_number,
            'photo' => $this->photo,
            'residency_photo' => $this->residency_photo,
            'is_verified' => $this->is_verified,
            'main_category_id' => $this->main_category_id,
            'sub_category_id' => $this->sub_category_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'service_id' => $this->service_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
