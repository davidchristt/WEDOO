<?php

namespace App\Filament\Resources\EntertainmentResource\Pages;

use App\Filament\Resources\EntertainmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEntertainment extends EditRecord
{
    protected static string $resource = EntertainmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
