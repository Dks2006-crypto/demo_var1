<?php

namespace App\Filament\App\Resources\Cards\Pages;

use App\Filament\App\Resources\Cards\CardResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListCards extends ListRecords
{
    protected static string $resource = CardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Новая карточка'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'active' => Tab::make('Активные')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereIn('status', ['pending', 'published'])),

            'archive' => Tab::make('Архив')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereIn('status', ['rejected', 'archived'])),

            'all' => Tab::make('Все'),
        ];
    }
}
