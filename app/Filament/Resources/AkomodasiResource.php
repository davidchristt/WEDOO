<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Akomodasi;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Pages\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Actions\ButtonAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\AkomodasiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\AkomodasiResource\RelationManagers;
use App\Filament\Resources\AkomodasiResource\Pages\EditAkomodasi;
use App\Filament\Resources\AkomodasiResource\Pages\ListAkomodasis;
use App\Filament\Resources\AkomodasiResource\Pages\CreateAkomodasi;

class AkomodasiResource extends Resource
{
    protected static ?string $navigationLabel = 'Tim Akomodasi & Dekorasi';
    protected static ?string $model = Akomodasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Card::make()
                ->schema([    
                TextInput::make('nama')->required(),
                TextInput::make('kontak')->required()->default('08'),
                TextInput::make('biaya')->prefix('RP')->required()->mask(RawJs::make('$money($input)'))->stripCharacters(',')->numeric()->default(1000000),
                ToggleButtons::make('ketersediaan')
                    ->required()
                    ->options(Akomodasi::KETERSEDIAAN_OPSI)
                    ->colors([
                        'Tunggu' => 'info',
                        'Habis' => 'warning',
                        'Tersedia' => 'success',
                    ])
                    ->inline(),
                RichEditor::make('deskripsi')->nullable()->columnSpan(2),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('id_akomodasi')->sortable(),
            TextColumn::make('nama')->sortable()->searchable(),
            TextColumn::make('kontak')->sortable()->searchable(),
            TextColumn::make('biaya')->sortable()->money('Rp.'),
            TextColumn::make('ketersediaan')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'Tersedia' => 'success',
                                'Habis' => 'warning',
                                'Tunggu' => 'info',
                            }),
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
            'index' => Pages\ListAkomodasis::route('/'),
            'create' => Pages\CreateAkomodasi::route('/create'),
            'edit' => Pages\EditAkomodasi::route('/{record}/edit'),
        ];
    }
}
