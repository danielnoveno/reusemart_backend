<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Filament\Resources\AdminResource\RelationManagers;
use App\Models\Admin;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench';

    protected static ?string $navigationLabel = 'Manajemen Admin';

    public static ?string $label = 'Managemen Admin';

    protected static ?string $navigationGroup = 'All User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('NAMA_ADMIN')
                    ->required()
                    ->label('Nama Admin')
                    ->placeholder('Masukkan Nama Admin')
                    ->maxLength(255),
                TextInput::make('EMAIL_ADMIN')
                    ->required()
                    ->label('Email')
                    ->email()
                    ->placeholder('Masukkan Email')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('PASSWORD_ADMIN')
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
                TextColumn::make('NAMA_ADMIN')
                    ->searchable()
                    ->copyable()
                    ->label('Nama Admin')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('EMAIL_ADMIN')
                    ->copyable()
                    ->searchable()
                    ->label('Nama Admin')
                    ->sortable()
                    ->searchable()
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
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
