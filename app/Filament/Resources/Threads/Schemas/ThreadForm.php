<?php

namespace App\Filament\Resources\Threads\Schemas;

use App\Enums\Status;
use Exception;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

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

                MarkdownEditor::make('body')
                    ->columnSpanFull(),

                TextInput::make('views')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->columnSpanFull(),

                Toggle::make('is_pinned')
                    ->inlineLabel()
                    ->required(),

                Toggle::make('is_locked')
                    ->inlineLabel()
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
