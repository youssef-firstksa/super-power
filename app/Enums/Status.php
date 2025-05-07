<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum Status: string implements HasLabel, HasColor
{
    case ACTIVE = 'active';
    case DISABLED = 'disabled';
    case Hidden = 'hidden';

    public function isActive(): bool
    {
        return $this === self::ACTIVE;
    }

    public function isDisabled(): bool
    {
        return $this === self::DISABLED;
    }

    public function getLabel(): string
    {
        return ucwords(__('filament.' . $this->value));
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::ACTIVE => 'primary',
            self::DISABLED => 'danger',
        };
    }

    public static function basicOptions(): array
    {
        return [
            self::ACTIVE->value => self::ACTIVE->getLabel(),
            self::DISABLED->value => self::DISABLED->getLabel(),
        ];
    }
}
