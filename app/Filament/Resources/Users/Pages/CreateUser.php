<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        $roleName = $this->form->getState()['role'] ?? null;

        if ($roleName) {
            $this->record->assignRole($roleName);
        }
    }
}
