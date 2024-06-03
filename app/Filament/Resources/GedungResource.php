<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Gedung;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MultiSelect;
use App\Filament\Resources\GedungResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GedungResource\Pages\EditGedung;
use App\Filament\Resources\GedungResource\RelationManagers;
use App\Filament\Resources\GedungResource\Pages\ListGedungs;
use App\Filament\Resources\GedungResource\Pages\CreateGedung;

class GedungResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $model = Gedung::class;
    protected static ?string $navigationLabel = 'Gedung';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama_gedung')->required()->columnSpan(6),
                        TextInput::make('luas')->numeric()->required()->columnSpan(2)->suffix('M'),
                        TextInput::make('kapasitas')->numeric()->required()->columnSpan(2)->suffix('Orang'),
                        TextInput::make('kapasitas_parkir')->numeric()->required()->columnSpan(2)->suffix('Kendaraan'),
                        MultiSelect::make('fasilitas')->columnSpan(3)
                            ->relationship('fasilitas', 'nama_fasilitas')
                            ->required(),                      
                        TextInput::make('link_denah')->nullable()->columnSpan(3),
                    ])->columns(6),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_gedung')->sortable(),
                TextColumn::make('nama_gedung')->sortable()->searchable(),
                TextColumn::make('luas')->sortable(),
                TextColumn::make('kapasitas')->sortable(),
                TextColumn::make('kapasitas_parkir')->sortable(),
                TextColumn::make('fasilitas.nama_fasilitas')->label('Fasilitas')->sortable()->searchable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListGedungs::route('/'),
            'create' => Pages\CreateGedung::route('/create'),
            'edit' => Pages\EditGedung::route('/{record}/edit'),
        ];
    }
}