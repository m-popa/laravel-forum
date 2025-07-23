<?php

namespace App\Filament\Resources\Threads\Schemas;

use Exception;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ThreadInfolist
{
    /**
     * @throws Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),

                TextEntry::make('slug'),

                TextEntry::make('status'),

                TextEntry::make('views')
                    ->numeric(),

                IconEntry::make('is_pinned')
                    ->boolean(),

                IconEntry::make('is_locked')
                    ->boolean(),

                TextEntry::make('body')
                    ->markdown()
                    ->columnSpanFull(),

                TextEntry::make('user.name')
                    ->label('User'),

                TextEntry::make('category.name')
                    ->label('Category'),

                TextEntry::make('last_commented_at')
                    ->dateTime(),

                TextEntry::make('created_at')
                    ->dateTime(),

                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
