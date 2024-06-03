<?php

namespace App\Filament\Resources;

use App\Models\MC;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MCResource\Pages;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\MCResource\Pages\EditMC;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MCResource\Pages\ListMCS;
use App\Filament\Resources\MCResource\Pages\CreateMC;
use App\Filament\Resources\MCResource\RelationManagers;

class MCResource extends Resource
{
    protected static ?string $navigationLabel = 'MC';
    protected static ?string $navigationIcon = 'heroicon-o-microphone';
    protected static ?string $model = MC::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama')->required(),
                        TextInput::make('kontak')->required(),
                        TextInput::make('biaya')->prefix('RP')->required()->mask(RawJs::make('$money($input)'))->stripCharacters(',')->numeric()->default(1000000),
                        ToggleButtons::make('ketersediaan')
                        ->required()
                        ->options(MC::KETERSEDIAAN_OPSI)
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
                TextColumn::make('id_mc')->sortable(),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('kontak')->sortable()->searchable(),
                TextColumn::make('biaya')->sortable()->money('Rp.'),
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
            'index' => Pages\ListMCS::route('/'),
            'create' => Pages\CreateMC::route('/create'),
            'edit' => Pages\EditMC::route('/{record}/edit'),
        ];
    }
}
