<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenitipResource\Pages;
use App\Filament\Resources\PenitipResource\RelationManagers;
use App\Models\Penitip;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenitipResource extends Resource
{
    protected static ?string $model = Penitip::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Manajemen Penitip';

    protected static ?string $navigationGroup = 'All User';

    protected static ?string $slug = 'managemen-penitip';

    public static ?string $label = 'Managemen Penitip';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('NAMA_PENITIP')
                    ->required()
                    ->label('Nama Penitip')
                    ->placeholder('Masukkan Nama Penitip')
                    ->maxLength(255),
                TextInput::make('NO_KTP')
                    ->required()
                    ->numeric()
                    ->label('NIK')
                    ->placeholder('Masukkan NIK')
                    ->maxLength(255),
                TextInput::make('ALAMAT_PENITIP')
                    ->required()
                    ->label('Alamat')
                    ->placeholder('Masukkan Alamat')
                    ->maxLength(255),
                DatePicker::make('TGL_LAHIR_PENITIP')
                    ->required()
                    ->label('Tanggal Lahir')
                    ->placeholder('Masukkan Tanggal Lahir')
                    ->maxDate(now())
                    ->minDate(now()->subYears(100))
                    ->maxDate(now()->subYears(18))
                    ->displayFormat('d-m-Y'),
                TextInput::make('NO_TELP_PENITIP')
                    ->required()
                    ->label('No HP')
                    ->numeric()
                    ->placeholder('Masukkan No Telpon')
                    ->maxLength(255),
                TextInput::make('EMAIL_PENITIP')
                    ->required()
                    ->label('Email')
                    ->email()
                    ->placeholder('Masukkan Email')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('PASSWORD_PENITIP')
                    ->required()
                    ->label('Password')
                    ->password()
                    ->revealable()
                    ->placeholder('Masukkan Password')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn($state) => bcrypt($state))
                    ->dehydrated(fn($state) => ! blank($state))
                    ->minLength(8)
                    ->maxLength(255)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_penitip')
                    ->searchable()
                    ->copyable()
                    ->label('Nama Penitip')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('NIK')
                    ->searchable()
                    ->label('NIK')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('no_hp_penitip')
                    ->searchable()
                    ->label('No HP')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('alamat_penitip')
                    ->searchable()
                    ->label('Alamat')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email_penitip')
                    ->searchable()
                    ->copyable()
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->sortable()
                    ->dateTime()
                    ->dateTime('d-m-Y H:i:s'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPenitips::route('/'),
            'create' => Pages\CreatePenitip::route('/create'),
            'edit' => Pages\EditPenitip::route('/{record}/edit'),
        ];
    }
}
