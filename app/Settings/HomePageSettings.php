<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class HomePageSettings extends Settings
{
    public string $hero_title;
    public string $hero_subtitle;
    public string $categories_section_title;

    public static function group(): string
    {
        return 'home';
    }
}
