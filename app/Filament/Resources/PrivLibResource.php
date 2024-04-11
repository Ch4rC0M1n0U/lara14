<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrivLibResource\Pages;
use App\Filament\Resources\PrivLibResource\RelationManagers;
use App\Models\PrivLib;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrivLibResource extends Resource
{
    protected static ?string $model = PrivLib::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $modelLabel = 'Type de privation de liberté';
    protected static ?string $pluralModelLabel = 'Types de privation de liberté';

    protected static ?string $navigationLabel = 'Type(s) de P.L.';
    protected static ?string $navigationGroup = 'Configuration';
    protected static ?string $navigationBadgeTooltip = 'Liste des types de privation de liberté et gestion';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getBreadcrumb(): string
    {
        return 'Gestion des types de P.L.';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('TypeArrest')
                    ->label('Type de privation de liberté')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('MaxHour')
                    ->options([
                        '00:00' => '00:00',
                        '12:00' => '12:00',
                        '24:00' => '24:00',
                        '48:00' => '48:00',
                    ])
                    ->prefix('Nombre d\'heure :')
                    ->suffixIcon('heroicon-o-clock')
                    ->label('Durée maximale de privation de liberté')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('TypeArrest')
                    ->label('Type de privation de liberté')
                    ->searchable(),
                Tables\Columns\TextColumn::make('MaxHour')
                    ->label('Durée maximale de privation de liberté'),
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
            'index' => Pages\ListPrivLibs::route('/'),
            //'create' => Pages\CreatePrivLib::route('/create'),
            //'view' => Pages\ViewPrivLib::route('/{record}'),
            //'edit' => Pages\EditPrivLib::route('/{record}/edit'),
        ];
    }
}
