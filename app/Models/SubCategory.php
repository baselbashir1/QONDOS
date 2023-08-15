<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubCategory extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['type', 'image', 'category_id'];
    public $translatedAttributes = ['name'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategoryTranslations(): HasMany
    {
        return $this->hasMany(SubCategoryTranslation::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'sub_category_id');
    }
}
