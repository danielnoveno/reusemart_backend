<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiskusiPegawaiResource\Pages;
use App\Filament\Resources\DiskusiPegawaiResource\RelationManagers;
use App\Models\DiskusiPegawai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiskusiPegawaiResource extends Resource
{
    protected static ?string $model = DiskusiPegawai::class;

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
            'index' => Pages\ListDiskusiPegawais::route('/'),
            'create' => Pages\CreateDiskusiPegawai::route('/create'),
            'edit' => Pages\EditDiskusiPegawai::route('/{record}/edit'),
        ];
    }
}
