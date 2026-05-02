<?php

namespace App\Filament\App\Resources\Cards\Schemas;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CardForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('book_author')
                    ->label('Автор')
                    ->required(),
                TextInput::make('book_title')
                    ->label('Название')
                    ->required(),
                Radio::make('type')
                    ->label('Тип')
                    ->options([
                        'share'=>'Готов поделиться',
                        'want' => 'Хочу в библиотеку',
                    ])
                    ->required(),
                TextInput::make('published')
                    ->label('Издание'),
                TextInput::make('year')
                    ->label('Год издания'),
                Select::make('binding')
                    ->label('Состояние')
                    ->options([
                        'hard' => 'Твёрдое',
                        'soft' => 'Мягкое',
                    ]),
                Select::make('book_condition')
                    ->label('Состояние книги')
                    ->options([
                        'ideal' => 'Идеальное',
                        'normal' => 'Нормальное',
                        'attention' => 'Требует внимания',
                        'table_leg' => 'Подпирала ножку стола',
                    ]),
            ]);
    }
}
