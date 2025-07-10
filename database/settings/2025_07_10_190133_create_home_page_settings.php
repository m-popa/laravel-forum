<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('home.hero_title', 'Welcome to Laravel Forum');
        $this->migrator->add('home.hero_subtitle', 'Hero Subtitle');
        $this->migrator->add('home.categories_section_title', 'Categories Section Title');
    }
};
