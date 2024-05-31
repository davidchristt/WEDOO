<?php

namespace App\Filament\Resources\PeriasResource\Pages;

use App\Filament\Resources\PeriasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPerias extends ListRecords
{
    protected static string $resource = PeriasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
