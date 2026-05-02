<?php

namespace App\Filament\App\Resources\Cards\Tables;

use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CardsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
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
                TextColumn::make('rejected_reason')
                    ->label('Причина отказа')
                    ->wrap()
                    ->placeholder('—'),
                TextColumn::make('created_at')
                    ->label('Создана')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                Action::make('archive')
                    ->label('Удалить')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Удалить карточку?')
                    ->modalDescription('Карточка будет помещена в архив.')
                    ->action(fn ($record) => $record->update(['status' => 'archived']))
                    ->visible(fn ($record) => in_array($record->status, ['pending', 'published'], true)),
            ]);
    }
}
