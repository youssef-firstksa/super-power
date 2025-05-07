<?php

namespace App\Models;

use DOMDocument;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Page extends Model implements TranslatableContract
{
    use Translatable;

    protected $fillable = [
        'navigation_link_id',
    ];

    public $translatedAttributes = ['title', 'content'];

    public function navigationLink()
    {
        return $this->belongsTo(NavigationLink::class);
    }

    public function shortContent()
    {
        return Str::words(strip_tags($this->content), 20);
    }

    public function getFirstImageTag()
    {
        // Create a new DOMDocument instance
        $doc = new DOMDocument();

        // Suppress warnings for malformed HTML
        @$doc->loadHTML($this->content);

        // Get all img tags
        $images = $doc->getElementsByTagName('img');

        // Check if there’s no images
        if ($images->length == 0) return null;

        $firstImage = $images->item(0);
        return $firstImage->getAttribute('src');
    }
}
