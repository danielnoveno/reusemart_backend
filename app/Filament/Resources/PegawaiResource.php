<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PegawaiResource\Pages;
use App\Filament\Resources\PegawaiResource\RelationManagers;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class PegawaiResource extends Resource
{
    protected static ?string $model = Pegawai::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Pegawai';

    public static ?string $label = 'Pegawai';

    protected static ?string $navigationGroup = 'User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('ID_JABATAN')
                    ->label('ID Jabatan')
                    ->options(Jabatan::all()->pluck('NAMA_JABATAN', 'ID_JABATAN'))
                    ->searchable()
                    ->preload(),
                TextInput::make('NAMA_PEGAWAI')
                    ->required()
                    ->label('Nama Pegawai')
                    ->placeholder('Masukkan Nama Pegawai')
                    ->maxLength(255),
                TextInput::make('NO_TELP_PEGAWAI')
                    ->required()
                    ->label('No Telepon Pegawai')
                    ->placeholder('Masukkan No Telepon Pegawai')
                    ->maxLength(255),
                TextInput::make('EMAIL_PEGAWAI')
                    ->required()
                    ->label('Email Pegawai')
                    ->email()
                    ->placeholder('Masukkan Email Pegawai')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('PASSWORD_PEGAWAI')
                    ->required()
                    ->label('Password Pegawai')
                    ->password()
                    ->revealable()
                    ->placeholder('Masukkan Password Pegawai')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn($state) => bcrypt($state))
                    ->dehydrated(fn($state) => ! blank($state))
                    ->minLength(8)
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jabatans.NAMA_JABATAN')
                    ->label('Jabatan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('NAMA_PEGAWAI')
                    ->searchable()
                    ->copyable()
                    ->sortable()
                    ->label('Nama Pegawai'),
                TextColumn::make('NO_TELP_PEGAWAI')
                    ->searchable()
                    ->copyable()
                    ->sortable()
                    ->label('No Telepon Pegawai'),
                TextColumn::make('EMAIL_PEGAWAI')
                    ->searchable()
                    ->copyable()
                    ->sortable()
                    ->label('Email Pegawai'),
                TextColumn::make('KOMISI_PEGAWAI')
                    ->searchable()
                    ->copyable()
                    ->sortable()
                    ->label('Komisi Pegawai'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(function (Pegawai $record) {
                        $record->delete();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Pegawai')
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
            'index' => Pages\ListPegawais::route('/'),
            'create' => Pages\CreatePegawai::route('/create'),
            'edit' => Pages\EditPegawai::route('/{record}/edit'),
        ];
    }
}
