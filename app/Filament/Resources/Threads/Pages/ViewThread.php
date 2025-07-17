<?php

namespace App\Filament\Resources\Threads\Pages;

use App\Models\Thread;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Threads\ThreadResource;

class ViewThread extends ViewRecord
{
    protected static string $resource = ThreadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('publish')
                  ->label('Publish')
                  ->action(function (Thread $thread) {
                      $thread->markAsPublished();
                  })
                  ->visible(fn(Thread $record) => $record->isPending())
                  ->icon('heroicon-s-check-circle')
                  ->color('success'),

            Action::make('reject')
                  ->label('Reject')
                  ->action(function (Thread $record) {
                      $record->markAsRejected();
                  })
                  ->visible(fn(Thread $record) => $record->isPending())
                  ->icon('heroicon-s-x-circle')
                  ->color('secondary'),

            Action::make('pin')
                  ->label('Pin')
                  ->icon(Heroicon::OutlinedRectangleStack)
                  ->action(function (Thread $record) {
                      $record->update(['is_pinned' => true]);
                  })
                  ->visible(fn(Thread $record) => !$record->is_pinned)
                  ->color('success'),

            Action::make('unpin')
                  ->label('Unpin')
                  ->icon(Heroicon::OutlinedRectangleStack)
                  ->action(function (Thread $record) {
                      $record->update(['is_pinned' => false]);
                  })
                  ->visible(fn(Thread $record) => $record->is_pinned)
                  ->color('gray'),

            Action::make('lock')
                  ->label('Lock')
                  ->icon(Heroicon::OutlinedLockClosed)
                  ->action(function (Thread $record) {
                      $record->update(['is_locked' => true]);
                  })
                  ->visible(fn(Thread $record) => !$record->is_locked)
                  ->color('danger'),

            Action::make('unlock')
                  ->label('Unlock')
                  ->icon(Heroicon::OutlinedLockOpen)
                  ->action(function (Thread $record) {
                      $record->update(['is_locked' => false]);
                  })
                  ->visible(fn(Thread $record) => $record->is_locked)
                  ->color('gray'),


            EditAction::make(),
        ];
    }
}
