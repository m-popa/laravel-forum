<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum Status: int implements HasLabel
{
    case Published = 1;
    case Pending = 2;
    case Rejected = 3;

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Published => 'Published',
            self::Pending   => 'Pending',
            self::Rejected  => 'Rejected',
        };
    }
}
