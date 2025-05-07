<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiPembelianBarangResource\Pages;
use App\Filament\Resources\TransaksiPembelianBarangResource\RelationManagers;
use App\Models\TransaksiPembelianBarang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransaksiPembelianBarangResource extends Resource
{
    protected static ?string $model = TransaksiPembelianBarang::class;

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
            'index' => Pages\ListTransaksiPembelianBarangs::route('/'),
            'create' => Pages\CreateTransaksiPembelianBarang::route('/create'),
            'edit' => Pages\EditTransaksiPembelianBarang::route('/{record}/edit'),
        ];
    }
}
