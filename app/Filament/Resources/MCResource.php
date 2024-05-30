<?php

namespace App\Filament\Resources;

use App\Models\MC;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MCResource\Pages;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\MCResource\Pages\EditMC;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MCResource\Pages\ListMCS;
use App\Filament\Resources\MCResource\Pages\CreateMC;
use App\Filament\Resources\MCResource\RelationManagers;

class MCResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-microphone';
    protected static ?string $model = MC::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id_MC')->required(),
                TextInput::make('nama')->required(),
                TextInput::make('jenis')->required(),
                TextInput::make('harga')->numeric()->required(),
                Select::make('ketersediaan')
                    ->options(MC::KETERSEDIAAN_OPSI)
                    ->required(),
                TextInput::make('deskripsi')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_MC')->sortable(),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('jenis')->sortable()->searchable(),
                TextColumn::make('harga')->sortable(),
                TextColumn::make('ketersediaan')->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListMCS::route('/'),
            'create' => Pages\CreateMC::route('/create'),
            'edit' => Pages\EditMC::route('/{record}/edit'),
        ];
    }
}
