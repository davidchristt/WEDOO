<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Perias;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\PeriasResource\Pages;


class PeriasResource extends Resource
{
    protected static ?string $model = Perias::class;

    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama')->required(),
                        TextInput::make('kontak')->required(),
                        TextInput::make('biaya')->required()->prefix('RP')->required()->mask(RawJs::make('$money($input)'))->stripCharacters(',')->numeric()->default(1000000),
                        ToggleButtons::make('ketersediaan')
                        ->required()
                        ->options(Perias::KETERSEDIAAN_OPSI)
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
                TextColumn::make('id_perias')->sortable(),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('kontak')->sortable()->searchable(),
                TextColumn::make('biaya')->prefix('RP')->required()->mask(RawJs::make('$money($input)'))->stripCharacters(',')->numeric()->default(1000000),
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
