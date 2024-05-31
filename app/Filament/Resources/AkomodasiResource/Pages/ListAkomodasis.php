<?php

namespace App\Filament\Resources\AkomodasiResource\Pages;

use App\Filament\Resources\AkomodasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAkomodasis extends ListRecords
{
    protected static string $resource = AkomodasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
