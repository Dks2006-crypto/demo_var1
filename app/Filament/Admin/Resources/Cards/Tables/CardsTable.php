<?php

namespace App\Filament\Admin\Resources\Cards\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
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
                    ->label('Пользователь'),
                TextColumn::make('book_title')
                    ->label('Название'),
                TextColumn::make('book_author')
                    ->label('Автор'),
                TextColumn::make('type')
                    ->label('Тип'),
                TextColumn::make('status')
                    ->label('Статус')
                    ->badge(),
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
            ->searchable()
            ->recordActions([
                EditAction::make(),

                Action::make('publish')
                    ->label('Опубликовать')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(fn ($record) => $record->update(['status' => 'publish']))
                    ->visible(fn ($record) => $record->status === 'pending'),

                Action::make('reject')
                    ->label('Отклонить')
                    ->color('danger')
                    ->icon('heroicon-o-x-mark')
                    ->form([
                        Textarea::make('rejected_reason')
                            ->label('Прияина отказа')
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
