<?php

namespace App\Http\Resources;

use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    use GeneralTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'status' => $this->status,
            'maintenance_technician_id' => $this->maintenance_technician_id,
            'maintenance_technician_rate' => $this->maintenanceTechnician->ratings->avg('rate'),
            'client_id' => $this->client_id,
            'order_id' => $this->order_id,
            'distance' => $this->calculateDistance($this->client->latitude, $this->client->longitude, $this->maintenanceTechnician->latitude, $this->maintenanceTechnician->longitude) . 'm',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
