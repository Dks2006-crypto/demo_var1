<?php

namespace App\Filament\App\Resources\Cards\Pages;

use App\Filament\App\Resources\Cards\CardResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCard extends CreateRecord
{
    protected static string $resource = CardResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';
        return $data;
    }
}
