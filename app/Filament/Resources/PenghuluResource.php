<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Penghulu;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Pages\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\PenghuluResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PenghuluResource\RelationManagers;
use App\Filament\Resources\PenghuluResource\Pages\EditPenghulu;
use App\Filament\Resources\PenghuluResource\Pages\ListPenghulus;
use App\Filament\Resources\PenghuluResource\Pages\CreatePenghulu;

class PenghuluResource extends Resource
{
    protected static ?string $model = Penghulu::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('nama')->required(),
            TextInput::make('kontak')->required(),
            Select::make('ketersediaan')
                ->required()
                ->options(Penghulu::KETERSEDIAAN_OPSI),
            TextInput::make('deskripsi')->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('id_penghulu')->sortable(),
            TextColumn::make('nama')->sortable()->searchable(),
            TextColumn::make('kontak')->sortable()->searchable(),
            TextColumn::make('ketersediaan')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'Tunggu' => 'gray',
                                'habis' => 'warning',
                                'tersedia' => 'success',
                            })
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenghulus::route('/'),
            'create' => Pages\CreatePenghulu::route('/create'),
            'edit' => Pages\EditPenghulu::route('/{record}/edit'),
        ];
    }
}
