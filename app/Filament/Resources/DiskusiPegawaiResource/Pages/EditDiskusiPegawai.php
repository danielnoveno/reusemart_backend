<?php

namespace App\Filament\Resources\DiskusiPegawaiResource\Pages;

use App\Filament\Resources\DiskusiPegawaiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDiskusiPegawai extends EditRecord
{
    protected static string $resource = DiskusiPegawaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
