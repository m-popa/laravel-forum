<?php

namespace App\Filament\Pages;

use Exception;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Pages\SettingsPage;
use App\Settings\HomePageSettings;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class ManageHomePage extends SettingsPage
{
    protected static string $settings = HomePageSettings::class;


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

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
