<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Souvenir;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\SouvenirResource\Pages;


class SouvenirResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-lifebuoy';
    protected static ?string $model = Souvenir::class;
    protected static ?string $navigationLabel = 'Souvenir';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama')->required(),
                        TextInput::make('jenis')->required(),
                        TextInput::make('harga')->prefix('RP')->required()->mask(RawJs::make('$money($input)'))->stripCharacters(',')->numeric()->default(1000000),
                        ToggleButtons::make('ketersediaan')
                        ->required()
                        ->options(Souvenir::KETERSEDIAAN_OPSI)
                        ->colors([
                            'Tunggu' => 'info',
                            'Habis' => 'warning',
                            'Tersedia' => 'success',
                        ])
                        ->inline(),
                        RichEditor::make('deskripsi')->nullable(),                        
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_Souvenir')->sortable(),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('jenis')->sortable()->searchable(),
                TextColumn::make('harga')->prefix('RP')->required()->mask(RawJs::make('$money($input)'))->stripCharacters(',')->numeric()->default(1000000),
                TextColumn::make('ketersediaan')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'Tersedia' => 'success',
                                    'Habis' => 'warning',
                                    'Tunggu' => 'info',
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSouvenirs::route('/'),
            'create' => Pages\CreateSouvenir::route('/create'),
            'edit' => Pages\EditSouvenir::route('/{record}/edit'),
        ];
    }
}
