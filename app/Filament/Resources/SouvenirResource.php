<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Souvenir;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SouvenirResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SouvenirResource\RelationManagers;
use App\Filament\Resources\SouvenirResource\Pages\EditSouvenir;
use App\Filament\Resources\SouvenirResource\Pages\ListSouvenirs;
use App\Filament\Resources\SouvenirResource\Pages\CreateSouvenir;

class SouvenirResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-lifebuoy';
    protected static ?string $model = Souvenir::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id_Souvenir')->required(),
                TextInput::make('nama')->required(),
                TextInput::make('jenis')->required(),
                TextInput::make('harga')->numeric()->required(),
                Select::make('ketersediaan')
                    ->options(Souvenir::KETERSEDIAAN_OPSI)
                    ->required(),
                TextInput::make('deskripsi')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_Souvenir')->sortable(),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('jenis')->sortable()->searchable(),
                TextColumn::make('harga')->sortable(),
                TextColumn::make('ketersediaan')->sortable(),
            ])
            ->filters([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSouvenirs::route('/'),
            'create' => Pages\CreateSouvenir::route('/create'),
            'edit' => Pages\EditSouvenir::route('/{record}/edit'),
        ];
    }
}
