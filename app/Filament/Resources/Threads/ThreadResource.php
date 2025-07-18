<?php

namespace App\Filament\Resources\Threads;

use BackedEnum;
use App\Models\Thread;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\Threads\Pages\EditThread;
use App\Filament\Resources\Threads\Pages\ViewThread;
use App\Filament\Resources\Threads\Pages\ListThreads;
use App\Filament\Resources\Threads\Pages\CreateThread;
use App\Filament\Resources\Threads\Schemas\ThreadForm;
use App\Filament\Resources\Threads\Tables\ThreadsTable;
use App\Filament\Resources\Threads\Schemas\ThreadInfolist;

class ThreadResource extends Resource
{
    protected static ?string $model = Thread::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ThreadForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ThreadInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ThreadsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListThreads::route('/'),
            'create' => CreateThread::route('/create'),
            'view' => ViewThread::route('/{record}'),
            'edit' => EditThread::route('/{record}/edit'),
        ];
    }
}
