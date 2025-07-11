<?php

namespace App\Filament\Pages;

use App\Settings\HomePageSettings;
use Exception;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Schema;

class ManageHomePage extends SettingsPage
{
    protected static string $settings = HomePageSettings::class;

    protected static string|null|\UnitEnum $navigationGroup = 'Settings';

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('hero_title')
                    ->label('Hero Title')
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('hero_subtitle')
                    ->label('Hero Subtitle')
                    ->required()
                    ->columnSpanFull()
                    ->rows(5),

                TextInput::make('categories_section_title')
                    ->label('Categories Section Title')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
