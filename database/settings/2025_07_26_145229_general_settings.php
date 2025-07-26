<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('general.voting_enabled', true);
        $this->migrator->add('general.comment_moderation_enabled', false);
    }
};
