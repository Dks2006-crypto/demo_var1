<?php

namespace App\Filament\Admin\Resources\Cards\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CardsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Пользователь')
                    ->searchable(),
                TextColumn::make('book_title')
                    ->label('Название')
                    ->searchable(),
                TextColumn::make('book_author')
                    ->label('Автор')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Тип')
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'share' => 'Готов поделиться',
                        'want' => 'Хочу себе',
                        default => $state,
                    }),
                TextColumn::make('status')
                    ->label('Статус')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'pending' => 'На рассмотрении',
                        'published' => 'Опубликована',
                        'rejected' => 'Отклонена',
                        'archived' => 'В архиве',
                        default => $state,
                    })
                    ->color(fn (string $state) => match ($state) {
                        'pending' => 'warning',
                        'published' => 'success',
                        'rejected' => 'danger',
                        'archived' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Создана')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'На рассмотрении',
                        'published' => 'Опубликована',
                        'rejected' => 'Отклонена',
                        'archived' => 'В архиве',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                Action::make('publish')
                    ->label('Опубликовать')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn ($record) => $record->update([
                        'status' => 'published',
                        'rejected_reason' => null,
                    ]))
                    ->visible(fn ($record) => $record->status === 'pending'),

                Action::make('reject')
                    ->label('Отклонить')
                    ->color('danger')
                    ->icon('heroicon-o-x-mark')
                    ->form([
                        Textarea::make('rejected_reason')
                            ->label('Причина отказа')
                            ->required(),
                    ])
                    ->action(fn ($record, array $data) => $record->update([
                        'status' => 'rejected',
                        'rejected_reason' => $data['rejected_reason'],
                    ]))
                    ->visible(fn ($record) => $record->status === 'pending'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
