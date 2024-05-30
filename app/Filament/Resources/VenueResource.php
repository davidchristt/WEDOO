<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Venue;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\VenueResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\VenueResource\Pages\EditVenue;
use App\Filament\Resources\VenueResource\Pages\ListVenues;
use App\Filament\Resources\VenueResource\RelationManagers;
use App\Filament\Resources\VenueResource\Pages\CreateVenue;

class VenueResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $model = Venue::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id_venue')->required(),
                Select::make('id_gedung')
                    ->label('Gedung')
                    ->relationship('gedung', 'nama_gedung')
                    ->required(),
                TextInput::make('alamat')->required(),
                TextInput::make('biaya')->numeric()->required(),
                TextInput::make('tipe')->required(),
                Textarea::make('deskripsi')->nullable(),
                TextInput::make('kota')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_venue')->sortable(),
                TextColumn::make('gedung.nama_gedung')->label('Gedung')->sortable(),
                TextColumn::make('alamat')->sortable(),
                TextColumn::make('biaya')->sortable(),
                TextColumn::make('tipe')->sortable(),
                TextColumn::make('kota')->sortable(),
            ])
            ->filters([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVenues::route('/'),
            'create' => Pages\CreateVenue::route('/create'),
            'edit' => Pages\EditVenue::route('/{record}/edit'),
        ];
    }
}

