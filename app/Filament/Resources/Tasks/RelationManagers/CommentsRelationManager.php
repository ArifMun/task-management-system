<?php

namespace App\Filament\Resources\Tasks\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Actions\CreateAction;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions;
use Filament\Resources\RelationManagers\RelationManager;

class CommentsRelationManager extends RelationManager
{
    protected static string $relationship = 'comments';
    protected static ?string $recordTitleAttribute = 'comment';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Forms\Components\Textarea::make('body')
                ->label('Comment')
                ->required(),
            \Filament\Forms\Components\Select::make('parent_id')
                ->label('Reply to')
                ->options(fn($get, $record) => $record?->task?->comments?->pluck('comment', 'id') ?? [])
                ->nullable(),
            \Filament\Forms\Components\Hidden::make('user_id')
                ->default(fn() => auth()->id()),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Name'),
                Tables\Columns\TextColumn::make('Message'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->headerActions([
                Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['user_id'] = auth()->id(); // otomatis isi user
                        return $data;
                    }),
            ])
            ->filters([
                //
            ]);
    }
}
