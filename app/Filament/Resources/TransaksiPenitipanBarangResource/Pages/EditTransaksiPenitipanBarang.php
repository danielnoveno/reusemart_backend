<?php

namespace App\Filament\Resources\TransaksiPenitipanBarangResource\Pages;

use App\Filament\Resources\TransaksiPenitipanBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransaksiPenitipanBarang extends EditRecord
{
    protected static string $resource = TransaksiPenitipanBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
