<?php

namespace App\Filament\Resources\PenghuluResource\Pages;

use App\Filament\Resources\PenghuluResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenghulus extends ListRecords
{
    protected static string $resource = PenghuluResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
