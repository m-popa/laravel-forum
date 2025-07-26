<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public bool $voting_enabled = true;

    public static function group(): string
    {
        return 'general';
    }
}
