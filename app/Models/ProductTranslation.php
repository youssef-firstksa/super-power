<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    public $fillable = [
        'name',
        'description',
    ];

    public $timestamps = false;
}
