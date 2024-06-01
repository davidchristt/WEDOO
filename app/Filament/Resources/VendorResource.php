<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Vendor;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Select;
use Filament\Pages\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\VendorResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\VendorResource\Pages\EditVendor;
use App\Filament\Resources\VendorResource\RelationManagers;
use App\Filament\Resources\VendorResource\Pages\ListVendors;
use App\Filament\Resources\VendorResource\Pages\CreateVendor;

use function Laravel\Prompts\text;

class VendorResource extends Resource
{
    protected static ?string $model = Vendor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id_vendor')
                    ->required()
                    ->maxLength(10),
                TextInput::make('nama')->required(),
                Select::make('id_venue')
                    ->relationship('venue', 'id_venue')
                    ->required(),
                Select::make('id_souvenir')
                    ->relationship('souvenir', 'nama')
                    ->required(),
                Select::make('id_penghulu')
                    ->relationship('penghulu', 'nama')
                    ->required(),
                Select::make('id_mc')
                    ->relationship('mc', 'nama')
                    ->required(),
                Select::make('id_mobil')
                    ->relationship('mobil', 'nama_mobil')
                    ->required(),
                Select::make('id_akomodasi')
                    ->relationship('akomodasi', 'nama')
                    ->required(),
                Select::make('id_dokumentasi')
                    ->relationship('Dokumentasi', 'nama')
                    ->required(),
                Select::make('id_catering')
                    ->relationship('catering', 'nama')
                    ->required(),
                Select::make('id_entertainment')
                    ->relationship('entertainment', 'nama')
                    ->required(),
                Select::make('id_perias')
                    ->relationship('perias', 'nama')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_vendor')->sortable()->searchable(),
                TextColumn::make('venue.id_venue')->label('Venue')->sortable()->searchable(),
                TextColumn::make('souvenir.nama')->label('Souvenir')->sortable()->searchable(),
                TextColumn::make('penghulu.nama')->label('Penghulu')->sortable()->searchable(),
                TextColumn::make('mc.nama')->label('MC')->sortable()->searchable(),
                TextColumn::make('mobil.nama_mobil')->label('mobil')->sortable()->searchable(),
                TextColumn::make('akommodasi.nama')->label('akomodasi')->sortable()->searchable(),
                TextColumn::make('dokumentasi.nama')->label('Dokumentasi')->sortable()->searchable(),
                TextColumn::make('catering.nama')->label('Catering')->sortable()->searchable(),
                TextColumn::make('entertainment.nama')->label('entertainment')->sortable()->searchable(),
                TextColumn::make('perias.nama')->label('perias')->sortable()->searchable(),
            ])
            ->filters([
                // Add any filters here
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVendors::route('/'),
            'create' => Pages\CreateVendor::route('/create'),
            'edit' => Pages\EditVendor::route('/{record}/edit'),
        ];
    }
}
