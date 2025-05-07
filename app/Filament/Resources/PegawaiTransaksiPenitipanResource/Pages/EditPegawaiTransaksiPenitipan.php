<?php

namespace App\Filament\Resources\PegawaiTransaksiPenitipanResource\Pages;

use App\Filament\Resources\PegawaiTransaksiPenitipanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPegawaiTransaksiPenitipan extends EditRecord
{
    protected static string $resource = PegawaiTransaksiPenitipanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
