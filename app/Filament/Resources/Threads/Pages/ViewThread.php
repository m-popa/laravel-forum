<?php

namespace App\Filament\Resources\Threads\Pages;

use App\Filament\Resources\Threads\ThreadResource;
use App\Models\Thread;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Icons\Heroicon;

class ViewThread extends ViewRecord
{
    protected static string $resource = ThreadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('pin')
                ->label('Pin')
                ->icon(Heroicon::ArrowsPointingIn)
                ->action(fn (Thread $record) => $record->pin())
                ->visible(fn (Thread $record) => $record->isNotPinned())
                ->color('success'),

            Action::make('unpin')
                ->label('Unpin')
                ->icon(Heroicon::ArrowsPointingOut)
                ->action(fn (Thread $record) => $record->unpin())
                ->visible(fn (Thread $record) => $record->isPinned())
                ->color('gray'),

            Action::make('lock')
                ->label('Lock')
                ->icon(Heroicon::OutlinedLockClosed)
                ->action(fn (Thread $record) => $record->lock())
                ->visible(fn (Thread $record) => $record->isNotLocked())
                ->color('danger'),

            Action::make('unlock')
                ->label('Unlock')
                ->icon(Heroicon::OutlinedLockOpen)
                ->action(fn (Thread $record) => $record->unlock())
                ->visible(fn (Thread $record) => $record->isLocked())
                ->color('gray'),

            EditAction::make()
                ->icon(Heroicon::OutlinedPencil),
        ];
    }
}
