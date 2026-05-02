<?php

namespace App\Filament\App\Resources\Cards\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CardsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('book_title')
                    ->label('Название'),
                TextColumn::make('book_author')
                    ->label('Автор'),
                TextColumn::make('type')
                    ->label('Тип')
                    ->formatStateUsing(fn (string $state) => match($state) {
                        'share' => 'Готов поделиться',
                        'want' => 'Хочу себе',
                    }),
                TextColumn::make('status')
                    ->label('Статус')
                    ->badge(),
                TextColumn::make('rejected_reason')
                    ->label('Причина отказа'),


            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),

                Action::make('archve')
                    ->label('Удалить')
                    ->icon('heroicon-o-trach')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn ($record) => $record->update(['status' => 'archived']))
                    ->visible(fn ($record) => in_array($record->status, ['pending' => 'published'])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
