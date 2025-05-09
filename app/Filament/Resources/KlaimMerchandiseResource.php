<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KlaimMerchandiseResource\Pages;
use App\Filament\Resources\KlaimMerchandiseResource\RelationManagers;
use App\Models\KlaimMerchandise;
use App\Models\Merchandise;
use App\Models\Pembeli;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KlaimMerchandiseResource extends Resource
{
    protected static ?string $model = KlaimMerchandise::class;

    protected static ?string $navigationLabel = 'Klaim Merhandise';

    public static ?string $label = 'Klaim Merchandise';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Merchandise';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('ID_MERCHANDISE')
                    ->label('ID Merchandise')
                    ->options(Merchandise::all()->pluck('NAMA_MERCHANDISE', 'ID_MERCHANDISE'))
                    ->searchable()
                    ->required()
                    ->preload(),
                Select::make('ID_PEMBELI')
                    ->label('ID Pembeli')
                    ->options(Pembeli::all()->pluck('NAMA_PEMBELI', 'ID_PEMBELI'))
                    ->searchable()
                    ->preload()
                    ->required(),
                DatePicker::make('TGL_KLAIM')
                    ->label('Tanggal Klaim')
                    ->required(),
                DatePicker::make('TGL_PENGAMBILAN')
                    ->label('Tanggal Pengambilan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('merchandise.NAMA_MERCHANDISE')
                    ->label('Nama Merchandise')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('pembeli.NAMA_PEMBELI')
                    ->label('Nama Pembeli')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('TGL_KLAIM')
                    ->label('Tanggal Klaim')
                    ->sortable()
                    ->searchable()
                    ->date(),
                TextColumn::make('TGL_PENGAMBILAN')
                    ->label('Tanggal Pengambilan')
                    ->sortable()
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(function (KlaimMerchandise $record) {
                        $record->delete();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Klaim Merchandise')
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
            'index' => Pages\ListKlaimMerchandises::route('/'),
            'create' => Pages\CreateKlaimMerchandise::route('/create'),
            'edit' => Pages\EditKlaimMerchandise::route('/{record}/edit'),
        ];
    }
}
