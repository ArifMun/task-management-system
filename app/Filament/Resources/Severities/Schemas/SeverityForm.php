<?php

namespace App\Filament\Resources\Severities\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class SeverityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('color')
                    ->label('Color')
                    ->options([
                        'primary' => 'Primary (biru)',
                        'success' => 'Success (hijau)',
                        'warning' => 'Warning (kuning)',
                        'danger'  => 'Danger (merah)',
                        'info'    => 'Info (biru muda)',
                        'gray'    => 'Gray (abu-abu)',
                    ])
                    ->searchable()
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric(),
            ]);
    }
}
