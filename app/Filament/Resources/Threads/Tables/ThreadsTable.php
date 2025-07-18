<?php

namespace App\Filament\Resources\Threads\Tables;

use Exception;
use App\Enums\Status;
use App\Models\Thread;
use Filament\Tables\Table;
use Filament\Actions\Action;
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
     * @throws Exception
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
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                            ->options(Status::class),

                SelectFilter::make('category')
                            ->relationship('category', 'name'),
            ])
            ->recordActions([
                Action::make('publish')
                      ->label('Publish')
                      ->action(fn(Thread $thread) => $thread->markAsPublished())
                      ->icon('heroicon-s-check-circle')
                      ->color('success'),

                Action::make('reject')
                      ->label('Reject')
                      ->action(fn(Thread $thread) => $thread->markAsRejected())
                      ->icon('heroicon-s-x-circle')
                      ->color('gray'),

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
