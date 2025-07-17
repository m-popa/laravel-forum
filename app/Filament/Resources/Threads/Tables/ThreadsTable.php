<?php

namespace App\Filament\Resources\Threads\Tables;

use App\Enums\Status;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;

class ThreadsTable
{
    /**
     * @throws \Exception
     */
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                          ->searchable(),

                TextColumn::make('views')
                          ->numeric()
                          ->color('primary')
                          ->icon(Heroicon::Eye)
                          ->sortable(),

                TextColumn::make('status')
                          ->badge()
                          ->searchable(),

                IconColumn::make('is_pinned')
                          ->boolean(),

                IconColumn::make('is_locked')
                          ->boolean(),
                TextColumn::make('user.name')
                          ->numeric()
                          ->sortable(),

                TextColumn::make('created_at')
                          ->dateTime()
                          ->sortable()
                          ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                          ->dateTime()
                          ->sortable()
                          ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                            ->options(Status::class),

                SelectFilter::make('category')
                            ->relationship('category', 'name'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
