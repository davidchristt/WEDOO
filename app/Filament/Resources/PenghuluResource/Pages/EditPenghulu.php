<?php

namespace App\Filament\Resources\PenghuluResource\Pages;

use App\Filament\Resources\PenghuluResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenghulu extends EditRecord
{
    protected static string $resource = PenghuluResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
