<?php

namespace App\Filament\Resources\EnteirtaimentResource\Pages;

use App\Filament\Resources\EnteirtaimentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEnteirtaiment extends EditRecord
{
    protected static string $resource = EnteirtaimentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
