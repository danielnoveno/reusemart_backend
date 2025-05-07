<?php

namespace App\Filament\Resources\DetailTransaksiPembelianBarangResource\Pages;

use App\Filament\Resources\DetailTransaksiPembelianBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDetailTransaksiPembelianBarang extends EditRecord
{
    protected static string $resource = DetailTransaksiPembelianBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
