<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Dokumentasi;
use Filament\Support\RawJs;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Pages\Actions\EditAction;
use Filament\Pages\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DokumentasiResource\Pages;
use App\Filament\Resources\DokumentasiResource\RelationManagers;
use App\Filament\Resources\DokumentasiResource\Pages\EditDokumentasi;
use App\Filament\Resources\DokumentasiResource\Pages\ListDokumentasis;
use App\Filament\Resources\DokumentasiResource\Pages\CreateDokumentasi;

class DokumentasiResource extends Resource
{
    protected static ?string $navigationLabel = 'Tim Dokumentasi';
    protected static ?string $model = Dokumentasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make()
                ->schema([
                    TextInput::make('nama')->required(),
                    TextInput::make('kamera')->required()
                    ->datalist([
                        'Cannon',
                        'Sony',
                        'Nikon',
                        'Fujifilm',
                        'panasonic',
                    ]),
                    TextInput::make('kontak')->required(),
                    TextInput::make('biaya')->prefix('RP')->required()->mask(RawJs::make('$money($input)'))->stripCharacters(',')->numeric()->default(1000000),
                    ToggleButtons::make('ketersediaan')
                    ->required()
                    ->options(Dokumentasi::KETERSEDIAAN_OPSI)
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
            TextColumn::make('id_dokumentasi')->sortable(),
            TextColumn::make('nama')->sortable()->searchable(),
            TextColumn::make('kamera')->sortable()->searchable(),
            TextColumn::make('kontak')->sortable()->searchable(),
            TextColumn::make('biaya')->sortable()->money('Rp.'),
            TextColumn::make('ketersediaan')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'Tunggu' => 'gray',
                                'Habis' => 'warning',
                                'Tersedia' => 'success',
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
            'index' => Pages\ListDokumentasis::route('/'),
            'create' => Pages\CreateDokumentasi::route('/create'),
            'edit' => Pages\EditDokumentasi::route('/{record}/edit'),
        ];
    }
}
