<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DetailTransaksiPenitipBarangResource\Pages;
use App\Filament\Resources\DetailTransaksiPenitipBarangResource\RelationManagers;
use App\Models\DetailTransaksiPenitipBarang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DetailTransaksiPenitipBarangResource extends Resource
{
    protected static ?string $model = DetailTransaksiPenitipBarang::class;

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
            'index' => Pages\ListDetailTransaksiPenitipBarangs::route('/'),
            'create' => Pages\CreateDetailTransaksiPenitipBarang::route('/create'),
            'edit' => Pages\EditDetailTransaksiPenitipBarang::route('/{record}/edit'),
        ];
    }
}
