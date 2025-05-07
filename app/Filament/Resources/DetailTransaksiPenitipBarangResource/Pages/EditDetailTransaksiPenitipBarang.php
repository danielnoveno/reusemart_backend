<?php

namespace App\Filament\Resources\DetailTransaksiPenitipBarangResource\Pages;

use App\Filament\Resources\DetailTransaksiPenitipBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDetailTransaksiPenitipBarang extends EditRecord
{
    protected static string $resource = DetailTransaksiPenitipBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
