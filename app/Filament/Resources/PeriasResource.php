<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Perias;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Pages\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\PeriasResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PeriasResource\Pages\EditPerias;
use App\Filament\Resources\PeriasResource\Pages\ListPerias;
use App\Filament\Resources\PeriasResource\RelationManagers;
use App\Filament\Resources\PeriasResource\Pages\CreatePerias;

class PeriasResource extends Resource
{
    protected static ?string $model = Perias::class;

    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->required(),
                TextInput::make('kontak')->required(),
                TextInput::make('biaya')->numeric()->required(),
                Select::make('ketersediaan')
                    ->required()
                    ->options(perias::KETERSEDIAAN_OPSI),
                TextInput::make('deskripsi')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_perias')->sortable(),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('kontak')->sortable()->searchable(),
                TextColumn::make('biaya')->sortable(),
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
            'index' => Pages\ListPerias::route('/'),
            'create' => Pages\CreatePerias::route('/create'),
            'edit' => Pages\EditPerias::route('/{record}/edit'),
        ];
    }
}
