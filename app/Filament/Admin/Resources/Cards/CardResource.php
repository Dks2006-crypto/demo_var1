<?php

namespace App\Filament\Admin\Resources\Cards;

use App\Filament\Admin\Resources\Cards\Pages\CreateCard;
use App\Filament\Admin\Resources\Cards\Pages\EditCard;
use App\Filament\Admin\Resources\Cards\Pages\ListCards;
use App\Filament\Admin\Resources\Cards\Schemas\CardForm;
use App\Filament\Admin\Resources\Cards\Tables\CardsTable;
use App\Models\Card;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CardResource extends Resource
{
    protected static ?string $model = Card::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Card';

    protected static ?string $modelLabel = 'Заявка';
    protected static ?string $pluralModelLabel = 'Заявки';
    protected static ?string $navigationLabel = 'Заявки';

    public static function form(Schema $schema): Schema
    {
        return CardForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CardsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCards::route('/'),
        ];
    }
}
