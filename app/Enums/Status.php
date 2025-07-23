<?php

namespace App\Enums;

use BackedEnum;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum Status: int implements HasColor, HasIcon, HasLabel
{
    case Published = 1;
    case Pending = 2;
    case Rejected = 3;

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Published => 'Published',
            self::Pending => 'Pending',
            self::Rejected => 'Rejected',
        };
    }

    public function getIcon(): string|BackedEnum|null
    {
        return match ($this) {
            self::Published => 'heroicon-s-check-circle',
            self::Pending => 'heroicon-s-question-mark-circle',
            self::Rejected => 'heroicon-s-x-circle',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Published => 'success',
            self::Pending => 'warning',
            self::Rejected => 'danger',
        };
    }
}
