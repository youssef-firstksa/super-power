<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements TranslatableContract, HasMedia
{
    use Translatable, InteractsWithMedia;

    protected $fillable = [
        'price',
        'category_id',
    ];
    public $translatedAttributes = [
        'name',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function related()
    {
        $relatedCategoriesIds = [
            $this->category_id,
            ...$this->category->related()->pluck('id')->toArray(),
        ];

        return Product::query()
            ->whereNot('id', $this->id)
            ->whereIn('category_id', $relatedCategoriesIds)
            ->limit(3)
            ->get();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('images')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
