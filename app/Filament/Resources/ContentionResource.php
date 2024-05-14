<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Contention;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\ContentionResource\Pages;

class ContentionResource extends Resource
{
    protected static ?string $model = Contention::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('autorisedBy')
                ->label('Autorisé par')
                ->required()
                ->maxLength(50),
            DateTimePicker::make('autorised_DateHour')
                ->label('Date et Heure d\'autorisation')
                ->date('d/m/Y')
                ->time('H:i')
                ->native(true)
                ->default(now())
                ->required(),
            DateTimePicker::make('contention_DateHour')
                ->required()
                ->label('Date et Heure de placement de la contention')
                ->date('d/m/Y')
                ->time('H:i')
                ->native(true)
                ->default(now()),
            RichEditor::make('motivation')
                ->required()
                ->maxLength(255),
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
                Tables\Columns\TextColumn::make('autorisedBy')
                    ->searchable(),
                Tables\Columns\TextColumn::make('autorised_DateHour')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contention_DateHour')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('motivation')
                    ->searchable(),
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
            'index' => Pages\ListContentions::route('/'),
            'create' => Pages\CreateContention::route('/create'),
            'view' => Pages\ViewContention::route('/{record}'),
            'edit' => Pages\EditContention::route('/{record}/edit'),
        ];
    }
}
