<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $subCategories = [];
        foreach ($this->subCategories as $subCategory) {
            $subCategories[] = [
                'id' => $subCategory->id,
                'type' => $subCategory->type,
                'name' => ['ar' => $subCategory->translate('ar')->name, 'en' => $subCategory->translate('en')->name],
                'image' => $subCategory->image,
                'created_at' => $subCategory->created_at,
                'updated_at' => $subCategory->updated_at
            ];
        }

        return [
            'id' => $this->id,
            'type' => $this->type,
            'name' => ['ar' => $this->translate('ar')->name, 'en' => $this->translate('en')->name],
            'image' => $this->image,
            'sub-categories' => $subCategories,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
