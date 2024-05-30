<?php

namespace App\Filament\Resources\EnteirtaimentResource\Pages;

use App\Filament\Resources\EnteirtaimentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEnteirtaiments extends ListRecords
{
    protected static string $resource = EnteirtaimentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
