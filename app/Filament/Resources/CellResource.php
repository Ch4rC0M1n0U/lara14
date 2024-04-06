<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CellResource\Pages;
use App\Models\Cell;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use App\Models\Post;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TagsInput;

class CellResource extends Resource
{
    protected static ?string $model = Cell::class;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    protected static ?string $title = 'Cellule(s)';

    protected static ?string $navigationLabel = 'Cellule(s)';
    protected static ?string $navigationGroup = 'Configuration';
    protected static ?string $navigationBadgeTooltip = 'Liste des détenu(e)s et gestion';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {

        return $form
                ->schema([
                    Split::make([
                        Section::make('Configuration de la cellule')
                        ->description('Veuillez remplir les informations suivantes pour configurer la cellule.')
                        ->icon('heroicon-o-adjustments-vertical')
                        ->schema([                  
                            TextInput::make('CellNum')
                                ->label('Numéro de cellule')
                                ->live(),
                            TextInput::make('CellType')
                                ->label('Type de cellule')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('CellMax')
                                ->label('Nombre de places')
                                ->required()
                                ->numeric(),
                        ]),
                        Section::make([ 
                            Toggle::make('CellMinor')
                                ->label('Cellule mineure')
                                ->required(),
                            TagsInput::make('CellStat')
                                ->label('Statut de la cellule')
                                ->suggestions(['Libre', 'Occupée', 'En nettoyage', 'En réparation'])
                                ->required()
                                ->hiddenOn('edit'),
                        ])->grow(false),
                    ])->from('md'),                 
                ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('CellNum')
                    ->label('Numéro de cellule')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('CellType')
                    ->searchable()
                    ->sortable()
                    ->label('Type'),
                Tables\Columns\TextColumn::make('CellMax')
                    ->numeric()
                    ->sortable()
                    ->label('Places')
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\IconColumn::make('CellMinor')
                    ->boolean()
                    ->label('Mineure'),
                Tables\Columns\TextColumn::make('CellStat')
                    ->sortable()
                    ->label('Statut')
                    ->badge(),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCells::route('/'),
            'create' => Pages\CreateCell::route('/create'),
            'view' => Pages\ViewCell::route('/{record}'),
            'edit' => Pages\EditCell::route('/{record}/edit'),
        ];
    }
}
