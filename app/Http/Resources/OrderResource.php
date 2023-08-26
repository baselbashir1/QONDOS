<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'notes' => $this->notes,
            'client_id' => $this->client_id,
            'is_scheduled' => $this->is_scheduled,
            'visit_time' => $this->visit_time,
            'payment_type' => $this->payment_type,
            'payment_method' => $this->payment_method,
            'status' => $this->status,
            'order-services' => $this->orderServices,
            'order-images' => $this->orderImages,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
