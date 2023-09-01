<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $services = [];
        foreach ($this->services as $service) {
            $services[] = [
                'id' => $service->id,
                'type' => $service->type,
                'price' => $service->price,
                'name' => ['ar' => $service->translate('ar')->name, 'en' => $service->translate('en')->name],
                'image' => $service->image,
                'created_at' => $service->created_at,
                'updated_at' => $service->updated_at
            ];
        }

        return [
            'id' => $this->id,
            'type' => $this->type,
            'name' => ['ar' => $this->translate('ar')->name, 'en' => $this->translate('en')->name],
            'image' => $this->image,
            'category_id' => $this->category_id,
            'services' => $services,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
