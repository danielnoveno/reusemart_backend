<?php

namespace App\Filament\Resources\KategoribarangResource\Pages;

use App\Filament\Resources\KategoribarangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoribarang extends EditRecord
{
    protected static string $resource = KategoribarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
