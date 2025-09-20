<?php

namespace App\Filament\Resources\Severities\Pages;

use App\Filament\Resources\Severities\SeverityResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSeverity extends EditRecord
{
    protected static string $resource = SeverityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
