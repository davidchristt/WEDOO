<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Penghulu;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\PenghuluResource\Pages;

class PenghuluResource extends Resource
{
    protected static ?string $model = Penghulu::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Penghulu';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make()
                ->schema([
                    TextInput::make('nama')->required(),
                    TextInput::make('kontak')->required(),
                    ToggleButtons::make('ketersediaan')
                    ->required()
                    ->options(Penghulu::KETERSEDIAAN_OPSI)
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
            TextColumn::make('id_penghulu')->sortable(),
            TextColumn::make('nama')->sortable()->searchable(),
            TextColumn::make('kontak')->sortable()->searchable(),
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
            'index' => Pages\ListPenghulus::route('/'),
            'create' => Pages\CreatePenghulu::route('/create'),
            'edit' => Pages\EditPenghulu::route('/{record}/edit'),
        ];
    }
}
