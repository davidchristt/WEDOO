<?php

namespace App\Filament\Resources\MCResource\Pages;

use App\Filament\Resources\MCResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMC extends EditRecord
{
    protected static string $resource = MCResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
