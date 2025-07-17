<?php

namespace App\Filament\Resources\Threads\Schemas;

use Exception;
use App\Enums\Status;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;

class ThreadForm
{
    /**
     * @throws Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                         ->required(),

                TextInput::make('slug'),

                Select::make('status')
                      ->options(Status::class)
                      ->enum(Status::class)
                      ->required(),

                Textarea::make('content')
                        ->columnSpanFull(),

                TextInput::make('views')
                         ->required()
                         ->numeric()
                         ->default(0),

                Toggle::make('is_pinned')
                      ->required(),

                Toggle::make('is_locked')
                      ->required(),

                Select::make('user_id')
                      ->relationship('user', 'name')
                      ->required(),

                Select::make('category_id')
                      ->relationship('category', 'name')
                      ->required(),

                DateTimePicker::make('last_commented_at'),
            ]);
    }
}
