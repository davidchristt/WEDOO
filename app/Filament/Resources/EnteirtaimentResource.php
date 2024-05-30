<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Entertaiment;
use Filament\Resources\Resource;
use Filament\Pages\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EnteirtaimentResource\Pages;
use App\Filament\Resources\EnteirtaimentResource\RelationManagers;
use App\Filament\Resources\EnteirtaimentResource\Pages\EditEnteirtaiment;
use App\Filament\Resources\EnteirtaimentResource\Pages\ListEnteirtaiments;
use App\Filament\Resources\EnteirtaimentResource\Pages\CreateEnteirtaiment;

class EnteirtaimentResource extends Resource
{
    protected static?string $model = Entertaiment::class;

    protected static?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id_entertaiment')->required(),
                TextInput::make('nama')->required(),
                TextInput::make('harga')->numeric()->required(),
                TextInput::make('kotak')->required(),
                TextInput::make('kategori')->required(),
                Textarea::make('deskripsi')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_entertaiment')->sortable(),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('harga')->sortable(),
                TextColumn::make('kontak')->sortable()->searchable(),
                TextColumn::make('kategori')->sortable()->searchable(),
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
            'index' => Pages\ListEnteirtaiments::route('/'),
            'create' => Pages\CreateEnteirtaiment::route('/create'),
            'edit' => Pages\EditEnteirtaiment::route('/{record}/edit'),
        ];
    }
}