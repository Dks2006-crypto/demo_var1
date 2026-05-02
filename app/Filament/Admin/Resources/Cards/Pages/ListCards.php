<?php

namespace App\Filament\Admin\Resources\Cards\Pages;

use App\Filament\Admin\Resources\Cards\CardResource;
use Filament\Resources\Pages\ListRecords;

class ListCards extends ListRecords
{
    protected static string $resource = CardResource::class;
}
