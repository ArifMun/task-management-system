<?php

namespace App\Filament\Resources\Tasks\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class TasksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('status.name')
                    ->label('Status')
                    ->sortable()
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => str_replace('_', ' ', ucwords($state))),
                TextColumn::make('severity.name')
                    ->label('Severity')
                    ->sortable()
                    ->badge()
                    ->color(fn($record) => $record->severity?->color),
                TextColumn::make('developer.name')
                    ->label('Developer')
                    ->sortable(),
                TextColumn::make('createdBy.name')
                    ->label('Created By')
                    ->sortable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('finish_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('severity_id')
                    ->label('Severity')
                    ->relationship('severity', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('status_id')
                    ->label('Status')
                    ->relationship('status', 'name')
                    ->searchable()
                    ->preload()
                    ->getOptionLabelUsing(function ($value) {
                        if (!$value) return '';
                        $status = \App\Models\Status::find($value);
                        return $status ? str_replace('_', ' ', ucwords($status->name)) : '';
                    })
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
