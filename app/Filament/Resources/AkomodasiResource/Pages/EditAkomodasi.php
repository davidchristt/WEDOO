<?php

namespace App\Filament\Resources\AkomodasiResource\Pages;

use App\Filament\Resources\AkomodasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAkomodasi extends EditRecord
{
    protected static string $resource = AkomodasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
