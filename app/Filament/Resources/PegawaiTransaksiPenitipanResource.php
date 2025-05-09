<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PegawaiTransaksiPenitipanResource\Pages;
use App\Filament\Resources\PegawaiTransaksiPenitipanResource\RelationManagers;
use App\Models\PegawaiTransaksiPenitipan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PegawaiTransaksiPenitipanResource extends Resource
{
    protected static ?string $model = PegawaiTransaksiPenitipan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ID_TRANSAKSI_PENITIPAN')
                    ->label('Transaksi Penitipan')
                    ->options(\App\Models\TransaksiPembelianBarang::all()->pluck('ID_TRANSAKSI_PENITIPAN', 'ID_TRANSAKSI_PENITIPANs'))
                    ->required()
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->columnSpanFull(),
                Forms\Components\Select::make('ID_PEGAWAI')
                    ->label('Pegawai')
                    ->options(\App\Models\Pegawai::all()->pluck('NAMA_PEGAWAI', 'ID_PEGAWAI'))
                    ->required()
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pegawais.NAMA_PEGAWAI')
                    ->label('Nama Pegawai')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('transaksi_penitipan_barangs.ID_TRANSAKSI_PENITIPAN')
                    ->label('ID Transaksi Penitipan')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(function (PegawaiTransaksiPenitipan $record) {
                        $record->delete();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Transaksi Pegawai')
                    ->label('Apakah Anda yakin ingin menghapus transaksi ini?')
                    ->modalHeading('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPegawaiTransaksiPenitipans::route('/'),
            'create' => Pages\CreatePegawaiTransaksiPenitipan::route('/create'),
            'edit' => Pages\EditPegawaiTransaksiPenitipan::route('/{record}/edit'),
        ];
    }
}
