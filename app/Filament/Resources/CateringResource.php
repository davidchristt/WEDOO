<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Catering;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\CateringResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CateringResource\RelationManagers;
use App\Filament\Resources\CateringResource\Pages\EditCatering;
use App\Filament\Resources\CateringResource\Pages\ListCaterings;
use App\Filament\Resources\CateringResource\Pages\CreateCatering;

class CateringResource extends Resource
{
    protected static ?string $navigationLabel = 'Catering';

    protected static ?string $model = Catering::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->required(),
                TextInput::make('kontak')->required(),
                TextInput::make('biaya')->numeric()->required(),
                TextInput::make('deskripsi')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_catering')->sortable(),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('kontak')->sortable()->searchable(),
                TextColumn::make('biaya')->sortable(),
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
            'index' => Pages\ListCaterings::route('/'),
            'create' => Pages\CreateCatering::route('/create'),
            'edit' => Pages\EditCatering::route('/{record}/edit'),
        ];
    }
}
