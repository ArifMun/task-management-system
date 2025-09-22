<?php

namespace App\Filament\Resources\Tasks\RelationManagers;

use Filament\Tables;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\RelationManagers\RelationManager;

class CommentsRelationManager extends RelationManager
{
    protected static string $relationship = 'comments';
    protected static ?string $recordTitleAttribute = 'body';
    public ?int $replyToId = null;
    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Textarea::make('body')
                ->label('Comment')
                ->required(),

            Hidden::make('parent_id')
                ->default(null),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(
                fn(Builder $query) => $query
                    ->whereNull('parent_id')
                    ->with(['user', 'replies.user', 'replies.replies.user'])
                    ->orderBy('created_at')
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Name')->html()
                    ->formatStateUsing(function ($state, $record) {
                        return $this->renderNameTree($record);
                    }),

                // Pesan dengan indent sesuai kedalaman parent
                Tables\Columns\TextColumn::make('body')
                    ->label('Message')
                    ->html()
                    ->formatStateUsing(function ($state, $record) {
                        return $this->renderCommentTree($record);
                    }),


                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->html()
                    ->formatStateUsing(function ($state, $record) {
                        return $this->renderCreatedTree($record);
                    }),
            ])
            ->recordActions([
                Action::make('reply')
                    ->label('Reply')
                    ->form([
                        Textarea::make('body')
                            ->label('Reply')
                            ->required(),
                    ])
                    ->action(function (array $data, $record): void {
                        $record->replies()->create([
                            'body' => $data['body'],
                            'user_id' => auth()->id(),
                            'task_id' => $record->task_id,
                            'parent_id' => $record->id,
                        ]);
                    }),
            ]);
    }

    // header action untuk membuat comment baru (bisa dipakai juga untuk reply via UI lain)
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    $data['user_id'] = auth()->id();
                    $data['task_id'] = $this->getOwnerRecord()->id;
                    $data['parent_id'] = $this->replyToId;
                    return $data;
                })
                ->after(function () {
                    $this->replyToId = null;
                }),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->with(['user', 'replies.user', 'replies.replies']) // load parent + children
            ->whereNull('parent_id') // HANYA parent
            ->orderBy('created_at');
    }
    protected function renderCommentTree($comment, $depth = 0): string
    {
        // indentasi per level
        $indent = str_repeat('<span style="display:inline-block;width:1.5rem"></span>', $depth);

        // baris utama
        $html = $indent . ($depth ? '↳ ' : '') . e($comment->body);

        // anak-anaknya (replies)
        foreach ($comment->replies->sortBy('created_at') as $reply) {
            $html .= '<br>' . $this->renderCommentTree($reply, $depth + 1);
        }

        return $html;
    }

    protected function renderNameTree($name, $depth = 0): string
    {
        $indent = str_repeat('<span style="display:inline-block;width:1.5rem"></span>', $depth);

        $html = $indent . ($depth ? '↳ ' : '') . e($name->user->name);

        foreach ($name->replies->sortBy('created_at') as $reply) {
            $html .= '<br>' . $this->renderNameTree($reply, $depth + 1);
        }

        return $html;
    }
    protected function renderCreatedTree($date, $depth = 0): string
    {
        $indent = str_repeat('<span style="display:inline-block;width:1.5rem"></span>', $depth);

        $html = $indent . ($depth ? '↳ ' : '') . e($date->created_at);
        foreach ($date->replies->sortBy('created_at') as $reply) {
            $html .= '<br>' . $this->renderCreatedTree($reply, $depth + 1);
        }

        return $html;
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
