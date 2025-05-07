<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoribarangResource\Pages;
use App\Filament\Resources\KategoribarangResource\RelationManagers;
use App\Models\Kategoribarang;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KategoribarangResource extends Resource
{
    protected static ?string $model = Kategoribarang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Manajemen Kategori Barang';

    public static ?string $label = 'Managemen Kategori Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('NAMA_KATEGORI')
                    ->required()
                    ->label('Nama Kategori')
                    ->placeholder('Masukkan Nama Kategori')
                    ->maxLength(255),
                TextInput::make('JML_PRODUK')
                    ->required()
                    ->label('Jumlah Produk')
                    ->placeholder('Masukkan Jumlah Produk')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(10000)
                    ->default(0)
                    ->maxLength(11)
                    ->dehydrateStateUsing(fn($state) => (int) $state)
                    ->dehydrated(fn($state) => ! blank($state))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ID_KATEGORI')
                    ->label('ID Kategori')
                    ->sortable()
                    ->placeholder('Masukkan ID Kategori')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('NAMA_KATEGORI')
                    ->label('Nama Kategori')
                    ->sortable()
                    ->placeholder('Masukkan Nama Kategori')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('JML_PRODUK')
                    ->label('Jumlah Produk')
                    ->sortable()
                    ->placeholder('Masukkan Jumlah Produk')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->sortable()
                    ->placeholder('Masukkan Tanggal Dibuat')
                    ->dateTime()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListKategoribarangs::route('/'),
            'create' => Pages\CreateKategoribarang::route('/create'),
            'edit' => Pages\EditKategoribarang::route('/{record}/edit'),
        ];
    }
}
