<?php

namespace App\Traits;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Builder;

trait HasStatus
{
    public function scopeActive(Builder $builder): Builder
    {
        return $builder->where('status', Status::ACTIVE);
    }

    public function scopeDisabled(Builder $builder): Builder
    {
        return $builder->where('status', Status::DISABLED);
    }
}
