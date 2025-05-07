<?php

namespace App\Models;

use App\Enums\Status;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class AppSetting extends Model implements TranslatableContract
{
    use HasStatus, Translatable;

    protected $fillable = [
        'key',
        'status',
        'image_path',
    ];

    public $translatedAttributes = [
        'label',
        'value',
    ];

    protected $casts = [
        'status' => Status::class,
    ];
}
