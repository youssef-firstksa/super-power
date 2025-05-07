<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PageTranslation extends Model
{
    protected $fillable = [
        'title',
        'content',
    ];
    public $timestamps = false;
}
