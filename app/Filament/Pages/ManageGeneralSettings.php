<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Pages\SettingsPage;
use App\Settings\GeneralSettings;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Toggle;

class ManageGeneralSettings extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|null|\UnitEnum $navigationGroup = 'Settings';

    protected static string $settings = GeneralSettings::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Toggle::make('voting_enabled')
                      ->label('Enable Voting')
                      ->helperText('Enable voting of comments on threads')
                      ->required()
                      ->columnSpanFull(),

                Toggle::make('comment_moderation_enabled')
                      ->label('Enable Comment Moderation')
                      ->helperText('Enable moderation of comments on threads')
                      ->required()
                      ->columnSpanFull(),
            ]);
    }
}
