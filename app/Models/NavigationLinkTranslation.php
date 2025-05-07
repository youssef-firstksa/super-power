<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationLinkTranslation extends Model
{
    protected $fillable = [
        'label',
    ];

    public $timestamps = false;
}
