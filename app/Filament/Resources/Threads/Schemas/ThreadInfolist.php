<?php

namespace App\Filament\Resources\Threads\Schemas;

use Exception;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;

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
                TextEntry::make('user.name')
                         ->numeric(),
                TextEntry::make('category.name')
                         ->numeric(),
                TextEntry::make('last_commented_at')
                         ->dateTime(),
                TextEntry::make('created_at')
                         ->dateTime(),
                TextEntry::make('updated_at')
                         ->dateTime(),
            ]);
    }
}
