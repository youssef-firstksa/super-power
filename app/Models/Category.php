<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements TranslatableContract
{
    use Translatable;

    protected $fillable = [
        'parent_id',
        'image_path',
    ];

    public $translatedAttributes = [
        'name'
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function related()
    {
        $this->load(['parent', 'parent.children', 'children']);

        $categories = collect([
            $this->parent,
            ...($this->parent?->children()->whereNot('id', $this->id)->get() ?? []),
            ...($this?->children()->whereNot('id', $this->id)->get() ?? []),
        ]);

        return $categories;
    }
}
