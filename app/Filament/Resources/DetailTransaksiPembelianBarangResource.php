<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DetailTransaksiPembelianBarangResource\Pages;
use App\Filament\Resources\DetailTransaksiPembelianBarangResource\RelationManagers;
use App\Models\DetailTransaksiPembelianBarang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DetailTransaksiPembelianBarangResource extends Resource
{
    protected static ?string $model = DetailTransaksiPembelianBarang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListDetailTransaksiPembelianBarangs::route('/'),
            'create' => Pages\CreateDetailTransaksiPembelianBarang::route('/create'),
            'edit' => Pages\EditDetailTransaksiPembelianBarang::route('/{record}/edit'),
        ];
    }
}
