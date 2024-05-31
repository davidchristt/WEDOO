<?php

namespace App\Filament\Resources\EntertainmentResource\Pages;

use App\Filament\Resources\EntertainmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEntertainments extends ListRecords
{
    protected static string $resource = EntertainmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
