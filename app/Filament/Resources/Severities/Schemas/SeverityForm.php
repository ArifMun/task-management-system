<?php

namespace App\Filament\Resources\Severities\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SeverityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('color'),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric(),
            ]);
    }
}
