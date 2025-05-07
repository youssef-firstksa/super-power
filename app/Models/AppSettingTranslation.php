<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSettingTranslation extends Model
{
    protected $fillable = [
        'label',
        'value',
    ];
    public $timestamps = false;
}
