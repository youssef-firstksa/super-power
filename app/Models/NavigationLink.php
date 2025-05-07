<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class NavigationLink extends Model implements TranslatableContract
{
    use Translatable;

    protected $fillable = [
        'slug',
        'page_type',
        'cms_page',
        'controller',
        'action',
        'order',
        'parent_id',
        'status',
    ];

    public $translatedAttributes = ['label'];

    public function parent()
    {
        return $this->belongsTo(NavigationLink::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(NavigationLink::class, 'parent_id');
    }

    public function page()
    {
        return $this->hasOne(Page::class);
    }
}
