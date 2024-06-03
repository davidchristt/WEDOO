<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Venue;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\VenueResource\Pages;

class VenueResource extends Resource
{
    protected static ?string $model = Venue::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Venues';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                    Select::make('id_gedung')
                        ->relationship('gedung', 'nama_gedung')
                        ->required(),
                    TextInput::make('alamat')
                        ->required(),
                    TextInput::make('kota')
                        ->required(),
                    TextInput::make('biaya')
                        ->prefix('RP')->required()->mask(RawJs::make('$money($input)'))->stripCharacters(',')->numeric()->default(1000000),
                    TextInput::make('tipe')
                        ->required(),
                    RichEditor::make('deskripsi')
                        ->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                    TextColumn::make('id_venue')
                        ->searchable(),
                    TextColumn::make('id_gedung')
                        ->searchable(),
                    TextColumn::make('alamat')
                        ->searchable(),
                    TextColumn::make('kota')
                        ->searchable(),
                    TextColumn::make('tipe')
                        ->searchable(),
                    TextColumn::make('biaya')
                        ->sortable()
                        ->numeric()
                        ->money('Rp.'),                        
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
            'index' => Pages\ListVenues::route('/'),
            'create' => Pages\CreateVenue::route('/create'),
            'edit' => Pages\EditVenue::route('/{record}/edit'),
        ];
    }
}
