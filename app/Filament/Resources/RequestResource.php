<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequestResource\Pages;
use App\Filament\Resources\RequestResource\RelationManagers;
use App\Models\Barang;
use App\Models\Organisasi;
use App\Models\Request;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RequestResource extends Resource
{
    protected static ?string $model = Request::class;

    protected static ?string $navigationLabel = 'Request Barang';

    public static ?string $label = 'Request Barang';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Organisasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('ID_ORGANISASI')
                    ->label('ID Organisasi')
                    ->options(Organisasi::all()->pluck('NAMA_ORGANISASI', 'ID_ORGANISASI'))
                    ->searchable()
                    ->preload(),
                Select::make('ID_BARANG')
                    ->label('Barang')
                    ->options(Barang::all()->pluck('NAMA_BARANG', 'ID_BARANG'))
                    ->searchable()
                    ->preload(),
                DatePicker::make('CREATE_AT')
                    ->label('Tanggal Request')
                    ->required()
                    ->default(now()),
                Textarea::make('DESKRIPSI_REQUEST')
                    ->label('Deskripsi Request')
                    ->required()
                    ->maxLength(255),
                Select::make('STATUS_REQUEST')
                    ->label('Status Request')
                    ->options([
                        'Menunggu' => 'Menunggu',
                        'Diterima' => 'Diterima',
                        'Ditolak' => 'Ditolak',
                    ])
                    ->default('Menunggu')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ID_REQUEST')
                    ->label('ID Request')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('organisasi.NAMA_ORGANISASI')
                    ->label('Nama Organisasi')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('barang.NAMA_BARANG')
                    ->label('Nama Barang')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('CREATE_AT')
                    ->label('Tanggal Request')
                    ->sortable()
                    ->searchable()
                    ->dateTime('d/m/Y'),
                TextColumn::make('DESKRIPSI_REQUEST')
                    ->label('Deskripsi Request')
                    ->sortable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('STATUS_REQUEST')
                    ->label('Status Request')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn(string $state): ?string => match ($state) {
                        'Menunggu' => 'warning',
                        'Diterima' => 'success',
                        'Ditolak' => 'danger',
                        default => null,
                    })
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(function (Request $record) {
                        $record->delete();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Request Donasi Barang')
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
            'index' => Pages\ListRequests::route('/'),
            'create' => Pages\CreateRequest::route('/create'),
            'edit' => Pages\EditRequest::route('/{record}/edit'),
        ];
    }
}
