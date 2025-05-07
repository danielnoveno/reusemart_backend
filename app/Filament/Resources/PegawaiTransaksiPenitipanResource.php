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
            'index' => Pages\ListPegawaiTransaksiPenitipans::route('/'),
            'create' => Pages\CreatePegawaiTransaksiPenitipan::route('/create'),
            'edit' => Pages\EditPegawaiTransaksiPenitipan::route('/{record}/edit'),
        ];
    }
}
