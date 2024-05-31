<?php

namespace App\Filament\Resources\PeriasResource\Pages;

use App\Filament\Resources\PeriasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPerias extends EditRecord
{
    protected static string $resource = PeriasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
