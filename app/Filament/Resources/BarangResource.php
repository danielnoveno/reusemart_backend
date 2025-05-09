<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Models\Barang;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $navigationLabel = 'Barang Titipan';

    public static ?string $label = 'Barang Titipan';

    protected static ?string $navigationGroup = 'Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('NAMA_BARANG')
                    ->required()
                    ->label('Nama Barang')
                    ->placeholder('Masukkan ID Barang')
                    ->maxLength(255),
                Select::make('ID_KATEGORI')
                    ->required()
                    ->label('Kategori Barang')
                    ->placeholder('Pilih Kategori')
                    ->relationship('kategoribarang', 'NAMA_KATEGORI')
                    ->searchable()
                    ->preload(),
                TextInput::make('HARGA_BARANG')
                    ->required()
                    ->label('Harga Barang')
                    ->placeholder('Masukkan Harga Barang')
                    ->numeric()
                    ->maxLength(255),
                DatePicker::make('TGL_MASUK')
                    ->required()
                    ->label('Tanggal Masuk')
                    ->placeholder('Masukkan Tanggal Masuk'),
                DatePicker::make('TGL_KELUAR')
                    ->label('Tanggal Keluar')
                    ->placeholder('Masukkan Tanggal Keluar')
                    ->nullable(),
                DatePicker::make('TGL_AMBIL')
                    ->label('Tanggal Ambil')
                    ->placeholder('Masukkan Tanggal Ambil')
                    ->nullable(),
                DatePicker::make('GARANSI')
                    ->label('Garansi')
                    ->placeholder('Masukkan Tanggal Garansi')
                    ->nullable(),
                TextInput::make('BERAT')
                    ->label('Berat')
                    ->placeholder('Masukkan Berat')
                    ->maxLength(255),
                MarkdownEditor::make('DESKRIPSI')
                    ->required()
                    ->label('Deskripsi')
                    ->maxLength(1000)
                    ->toolbarButtons([
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'edit',
                        'italic',
                        'orderedList',
                        'preview',
                        'strike',
                    ]),
                TextInput::make('RATING')
                    ->required()
                    ->label('Rating')
                    ->placeholder('Masukkan Rating')
                    ->maxLength(255)
                    ->default(0),
                Select::make('STATUS_BARANG')
                    ->required()
                    ->label('Status Barang')
                    ->placeholder('Masukkan Status Barang')
                    ->default('Tersedia')
                    ->options([
                        'Tersedia' => 'Tersedia',
                        'Terjual' => 'Terjual',
                        'Didonasikan' => 'Didonasikan',
                        'Diperpanjang' => 'Diperpanjang',
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('NAMA_BARANG')
                    ->searchable()
                    ->copyable()
                    ->label('Nama Barang')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('kategoribarang.NAMA_KATEGORI')
                    ->label('Nama Kategori')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('KODE_BARANG')
                    ->copyable()
                    ->searchable()
                    ->label('Kode Barang')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('HARGA_BARANG')
                    ->copyable()
                    ->searchable()
                    ->label('Harga Barang')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('TGL_MASUK')
                    ->date('d-m-Y')
                    ->copyable()
                    ->searchable()
                    ->label('Tanggal Masuk')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('TGL_KELUAR')
                    ->date('d-m-Y')
                    ->copyable()
                    ->searchable()
                    ->label('Tanggal Keluar')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('TGL_AMBIL')
                    ->date('d-m-Y')
                    ->copyable()
                    ->searchable()
                    ->label('Tanggal Ambil')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('GARANSI')
                    ->date('d-m-Y')
                    ->copyable()
                    ->searchable()
                    ->label('Garansi')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('BERAT')
                    ->copyable()
                    ->searchable()
                    ->label('Berat')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('DESKRIPSI')
                    ->copyable()
                    ->searchable()
                    ->label('Deskripsi')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('RATING')
                    ->copyable()
                    ->searchable()
                    ->label('Rating')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('STATUS_BARANG')
                    ->badge()
                    ->color(fn(string $state): ?string => match ($state) {
                        'Tersedia' => 'success',
                        'Terjual' => 'danger',
                        'Didonasikan' => 'warning',
                        'Diperpanjang' => 'primary',
                        default => null,
                    })
                    ->label('Status Barang')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(function (Barang $record) {
                        $record->delete();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Barang')
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
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
