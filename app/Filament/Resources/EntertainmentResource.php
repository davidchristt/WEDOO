<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use App\Models\Entertainment;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EntertainmentResource\Pages;
use App\Filament\Resources\EntertainmentResource\RelationManagers;
use App\Filament\Resources\EntertainmentResource\Pages\EditEntertainment;
use App\Filament\Resources\EntertainmentResource\Pages\ListEntertainments;
use App\Filament\Resources\EntertainmentResource\Pages\CreateEntertainment;

class EntertainmentResource extends Resource
{
    protected static?string $model = entertainment::class;
    protected static ?string $navigationLabel = 'Entertainment';

    protected static?string $navigationIcon = 'heroicon-o-musical-note';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama')->required(),
                        TextInput::make('biaya')->prefix('RP')->required()->mask(RawJs::make('$money($input)'))->stripCharacters(',')->numeric()->default(1000000),
                        TextInput::make('kontak')->required(),
                        TextInput::make('kategori')->required(),
                        ToggleButtons::make('ketersediaan')
                        ->required()
                        ->options(Entertainment::KETERSEDIAAN_OPSI)
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
                TextColumn::make('id_entertainment')->sortable(),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('biaya')->sortable()->money('Rp.'),
                TextColumn::make('kontak')->sortable()->searchable(),
                TextColumn::make('kategori')->sortable()->searchable(),
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
            'index' => Pages\ListEntertainments::route('/'),
            'create' => Pages\CreateEntertainment::route('/create'),
            'edit' => Pages\EditEntertainment::route('/{record}/edit'),
        ];
    }
}
