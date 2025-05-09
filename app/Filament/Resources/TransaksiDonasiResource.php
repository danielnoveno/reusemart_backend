<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiDonasiResource\Pages;
use App\Filament\Resources\TransaksiDonasiResource\RelationManagers;
use App\Models\Organisasi;
use App\Models\Request;
use App\Models\TransaksiDonasi;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransaksiDonasiResource extends Resource
{
    protected static ?string $model = TransaksiDonasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Transaksi Donasi Barang';

    public static ?string $label = 'Transaiksi Donasi Barang';

    protected static ?string $navigationGroup = 'Organisasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('ID_ORGANISASI')
                    ->label('Organisasi')
                    ->options(
                        Organisasi::query()
                            ->whereNotNull('NAMA_ORGANISASI')
                            ->pluck('NAMA_ORGANISASI', 'ID_ORGANISASI')
                    )
                    ->required()
                    ->searchable()
                    ->preload()
                    ->native(false),

                Select::make('ID_REQUEST')
                    ->label('Request Barang')
                    ->options(
                        Request::with('barang')
                            ->get()
                            ->mapWithKeys(function ($request) {
                                return [
                                    $request->ID_REQUEST => $request->barang->NAMA_BARANG ?? 'Unknown Barang'
                                ];
                            })
                    )
                    ->required()
                    ->searchable()
                    ->preload()
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ID_TRANSAKSI_DONASI')
                    ->label('ID Transaksi Donasi')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('organisasi.NAMA_ORGANISASI')
                    ->label('Organisasi')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('request.ID_REQUEST')
                    ->label('Request')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('TGL_DONASI')
                    ->label('Tanggal Donasi')
                    ->date('d/m/Y')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('PENERIMA')
                    ->label('Penerima')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(function (TransaksiDonasi $record) {
                        $record->delete();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Transaksi Donasi Barang')
                    ->label('Hapus')
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
            'index' => Pages\ListTransaksiDonasis::route('/'),
            'create' => Pages\CreateTransaksiDonasi::route('/create'),
            'edit' => Pages\EditTransaksiDonasi::route('/{record}/edit'),
        ];
    }
}
