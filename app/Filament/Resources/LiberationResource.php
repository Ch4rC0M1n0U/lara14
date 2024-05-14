<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LiberationResource\Pages;
use App\Models\Liberation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LiberationResource extends Resource
{
    protected static ?string $model = Liberation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('liberationDateHour'),
                Forms\Components\Toggle::make('dev_Before')
                    ->required(),
                Forms\Components\Toggle::make('avis_Before')
                    ->required(),
                Forms\Components\Toggle::make('mat_Before')
                    ->required(),
                Forms\Components\Toggle::make('libe_Before')
                    ->required(),
            ]);
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
                Tables\Columns\TextColumn::make('liberationDateHour')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('dev_Before')
                    ->boolean(),
                Tables\Columns\IconColumn::make('avis_Before')
                    ->boolean(),
                Tables\Columns\IconColumn::make('mat_Before')
                    ->boolean(),
                Tables\Columns\IconColumn::make('libe_Before')
                    ->boolean(),
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
            'index' => Pages\ListLiberations::route('/'),
            'create' => Pages\CreateLiberation::route('/create'),
            'view' => Pages\ViewLiberation::route('/{record}'),
            'edit' => Pages\EditLiberation::route('/{record}/edit'),
        ];
    }
}
