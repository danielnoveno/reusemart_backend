<?php

namespace App\Filament\Resources\KomisiResource\Pages;

use App\Filament\Resources\KomisiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKomisi extends EditRecord
{
    protected static string $resource = KomisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
