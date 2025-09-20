<?php

namespace App\Filament\Resources\Tasks\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Schemas\Schema;
use Tables\Actions\EditAction;
use Tables\Actions\CreateAction;
use Tables\Actions\DeleteAction;
use Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\RelationManagers\RelationManager;

class CommentsRelationManager extends RelationManager
{
    protected static string $relationship = 'comments';
    protected static ?string $recordTitleAttribute = 'comment';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Forms\Components\Textarea::make('comment')
                ->label('Comment')
                ->required(),
            \Filament\Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'pending' => 'Pending',
                    'resolved' => 'Resolved',
                    'review' => 'Review',
                ])
                ->default('pending')
                ->required(),
            \Filament\Forms\Components\Select::make('parent_id')
                ->label('Reply to')
                ->options(fn($get, $record) => $record?->task?->comments?->pluck('comment', 'id') ?? [])
                ->nullable(),
            \Filament\Forms\Components\Hidden::make('user_id')
                ->default(fn() => auth()->id()),
        ]);
    }

    public function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('User'),
                Tables\Columns\TextColumn::make('comment'),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->headerActions([
                \Filament\Actions\CreateAction::make()
            ])
            ->filters([
                //
            ]);
    }
}
