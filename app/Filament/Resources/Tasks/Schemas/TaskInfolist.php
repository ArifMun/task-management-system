<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TaskInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('status.name')
                    ->label('Status')
                    ->formatStateUsing(fn(string $state): string => str_replace('_', ' ', ucwords($state))),
                TextEntry::make('severity.name')
                    ->label('Severity')
                    ->badge()
                    ->color(fn($record) => $record->severity?->color),
                TextEntry::make('developer.name')
                    ->label('Developer Name'),
                TextEntry::make('createdBy.name')
                    ->label('Created By'),
                TextEntry::make('start_date')
                    ->date(),
                TextEntry::make('due_date')
                    ->date(),
                TextEntry::make('finish_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
