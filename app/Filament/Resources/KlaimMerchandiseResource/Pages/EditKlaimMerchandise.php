<?php

namespace App\Filament\Resources\KlaimMerchandiseResource\Pages;

use App\Filament\Resources\KlaimMerchandiseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlaimMerchandise extends EditRecord
{
    protected static string $resource = KlaimMerchandiseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
