<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Select::make('status_id')
                    ->label('Status')
                    ->relationship(
                        name: 'status',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn($query) => $query->orderBy('sort_order')
                    )
                    ->formatStateUsing(fn(string $state): string => str_replace('_', ' ', ucwords($state)))->getOptionLabelFromRecordUsing(fn($record) => str_replace('_', ' ', ucwords($record->name)))->formatStateUsing(
                        fn(?string $state): string => $state
                            ? str_replace('_', ' ', ucwords($state))
                            : ''
                    )
                    ->getOptionLabelFromRecordUsing(fn($record) => str_replace('_', ' ', ucwords($record->name)))

                    ->required(),
                Select::make('severity_id')
                    ->label('Severity')
                    ->relationship(
                        name: 'severity',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn($query) => $query->orderBy('sort_order')
                    )
                    ->required(),
                Select::make('developer_id')
                    ->label('Developer')
                    ->relationship('developer', 'name')
                    ->required(),

                Select::make('created_by')
                    ->label('Created By')
                    ->relationship('createdBy', 'name')
                    ->default(fn() => auth()->id()) // otomatis isi dengan user login
                    ->required()
                    ->reactive(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('due_date')
                    ->required(),
                DatePicker::make('finish_date'),
            ]);
    }
}
