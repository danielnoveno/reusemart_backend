<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiPembelianBarangResource\Pages;
use App\Filament\Resources\TransaksiPembelianBarangResource\RelationManagers;
use App\Models\Pembeli;
use App\Models\TransaksiPembelianBarang;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Date;

class TransaksiPembelianBarangResource extends Resource
{
    protected static ?string $model = TransaksiPembelianBarang::class;

    protected static ?string $navigationLabel = 'Transaiksi Pembelian Barang';

    public static ?string $label = 'Transaiksi Pembelian Barang';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('ID_PEMBELI')
                    ->label('Pembeli')
                    ->options(Pembeli::all()->pluck('NAMA_PEMBELI', 'ID_PEMBELI'))
                    ->required()
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->columnSpanFull(),
                FileUpload::make('BUKTI_TRANSFER')
                    ->label('Bukti Transfer')
                    ->required()
                    ->disk('public')
                    ->directory('bukti_transfer')
                    ->preserveFilenames()
                    ->columnSpanFull(),
                DatePicker::make('TGL_AMBIL_KIRIM')
                    ->required()
                    ->label('Tanggal Ambil Kirim')
                    ->placeholder('Pilih Tanggal Ambil Kirim')
                    ->columnSpanFull(),
                DatePicker::make('TGL_LUNAS_PEMBELIAN')
                    ->required()
                    ->label('Tanggal Lunas Pembelian')
                    ->placeholder('Pilih Tanggal Lunas Pembelian')
                    ->columnSpanFull(),
                DatePicker::make('TGL_PESAN_PEMBELIAN')
                    ->required()
                    ->label('Tanggal Pesan Pembelian')
                    ->placeholder('Pilih Tanggal Pesan Pembelian')
                    ->columnSpanFull(),
                TextInput::make('TOT_HARGA_PEMBELIAN')
                    ->label('Total Harga Pembelian')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->placeholder('Masukkan Total Harga Pembelian')
                    ->columnSpanFull(),
                Select::make('STATUS_TRANSAKSI')
                    ->required()
                    ->label('Status Transaksi')
                    ->placeholder('Masukkan Status Transaksi')
                    ->options([
                        'Lunas' => 'Lunas',
                        'Belum dibayar' => 'Belum dibayar',
                    ]),
                Select::make('DELIVERY_METHOD')
                    ->required()
                    ->label('Metode Pengiriman')
                    ->placeholder('Masukkan Metode Pengiriman')
                    ->options([
                        'Ambil Sendiri' => 'Ambil Sendiri',
                        'Di Kirim' => 'Di Kirim',
                    ]),
                TextInput::make('ONGKOS_KIRIM')
                    ->label('Ongkos Kirim')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->placeholder('Masukkan Ongkos Kirim')
                    ->columnSpanFull(),
                TextInput::make('POIN_DIDAPAT')
                    ->label('Poin Didapat')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->placeholder('Masukkan Poin Didapat')
                    ->columnSpanFull(),
                TextInput::make('POIN_POTONGAN')
                    ->label('Poin Potongan')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->placeholder('Masukkan Poin Potongan')
                    ->columnSpanFull(),
                Select::make('STATUS_BUKTI_TRANSFER')
                    ->required()
                    ->label('Status Bukti Transfer')
                    ->placeholder('Masukkan Status Transfer')
                    ->options([
                        'Valid' => 'Valid',
                        'Tidak Valid' => 'Tidak Valid',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ID_TRANSAKSI_PEMBELIAN')
                    ->label('ID Transaksi Pembelian')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('pembeli.NAMA_PEMBELI')
                    ->label('Nama Pembeli')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('BUKTI_TRANSFER')
                    ->label('Bukti Transfer')
                    ->url(fn(TransaksiPembelianBarang $record): string => $record->BUKTI_TRANSFER)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('TGL_AMBIL_KIRIM')
                    ->label('Tanggal Ambil Kirim')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('TGL_LUNAS_PEMBELIAN')
                    ->label('Tanggal Lunas Pembelian')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('TGL_PESAN_PEMBELIAN')
                    ->label('Tanggal Pesan Pembelian')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('TOT_HARGA_PEMBELIAN')
                    ->label('Total Harga Pembelian')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('STATUS_TRANSAKSI')
                    ->badge()
                    ->color(fn(string $state): ?string => match ($state) {
                        'Lunas' => 'success',
                        'Belum dibayar' => 'warning',
                        default => null,
                    })
                    ->label('Status Barang')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('DELIVERY_METHOD')
                    ->label('Metode Pengiriman')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('ONGKOS_KIRIM')
                    ->label('Ongkos Kirim')
                    ->sortable(),
                TextColumn::make('POIN_DIDAPAT')
                    ->label('Metode Pengiriman')
                    ->sortable(),
                TextColumn::make('POIN_POTONGAN')
                    ->label('Poin Potongan')
                    ->sortable(),
                TextColumn::make('STATUS_BUKTI_TRANSFER')
                    ->badge()
                    ->color(fn(string $state): ?string => match ($state) {
                        'Valid' => 'success',
                        'Tidak Valid' => 'danger',
                        default => null,
                    })
                    ->label('Status Bukti Transfer')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(function (TransaksiPembelianBarang $record) {
                        $record->delete();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Transaksi Pembelian Barang')
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
            'index' => Pages\ListTransaksiPembelianBarangs::route('/'),
            'create' => Pages\CreateTransaksiPembelianBarang::route('/create'),
            'edit' => Pages\EditTransaksiPembelianBarang::route('/{record}/edit'),
        ];
    }
}
