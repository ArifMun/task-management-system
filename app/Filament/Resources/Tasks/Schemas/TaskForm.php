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
                    ->relationship('status', 'name')
                    ->required(),
                Select::make('severity_id')
                    ->label('Severity')
                    ->relationship('severity', 'name')
                    ->required(),
                Select::make('developer_id')
                    ->label('Developer')
                    ->relationship('user', 'name')
                    ->required(),

                TextInput::make('created_by')
                    ->required()
                    ->numeric(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('due_date')
                    ->required(),
                DatePicker::make('finish_date'),
            ]);
    }
}
