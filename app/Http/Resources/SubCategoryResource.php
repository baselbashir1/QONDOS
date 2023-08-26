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
        return [
            'id' => $this->id,
            'type' => $this->type,
            'name_ar' => $this->translate('ar')->name,
            'name_en' => $this->translate('en')->name,
            'image' => $this->image,
            'category_id' => $this->category_id,
            'services' => $this->services,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
