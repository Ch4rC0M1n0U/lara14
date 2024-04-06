<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DetaineeResource\Pages;
use App\Models\Detainee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DetaineeResource extends Resource
{
    protected static ?string $model = Detainee::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';
    protected static ?string $navigationLabel = 'Détenu(s)';
    protected static ?string $navigationGroup = 'Gestion de la détention';
    protected static ?string $navigationBadgeTooltip = 'Liste des détenu(e)s et gestion';


    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('firstname')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lastname')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('birthdate')
                    ->required(),
                Forms\Components\TextInput::make('sexe')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cell_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('service_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('priv_lib_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('SSType')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('MaxPL')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('liberation_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('trusted_contact_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('isolement')
                    ->required(),
                Forms\Components\TextInput::make('RplNum')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('Salduz')
                    ->required(),
                Forms\Components\TextInput::make('DevRest')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('notice_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('user_created')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('Audition')
                    ->required(),
                Forms\Components\Toggle::make('PrintTrypt')
                    ->required(),
                Forms\Components\TextInput::make('contention_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('bac')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('Prohibe')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('incident_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('EqCharge')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('Avocate')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ProhiValImp')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('SurvCam')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('medical_id')
                    ->required()
                    ->numeric(),
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
                Tables\Columns\TextColumn::make('firstname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lastname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birthdate')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sexe')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cell_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('service_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('priv_lib_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('SSType')
                    ->searchable(),
                Tables\Columns\TextColumn::make('MaxPL')
                    ->searchable(),
                Tables\Columns\TextColumn::make('liberation_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('trusted_contact_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('isolement')
                    ->boolean(),
                Tables\Columns\TextColumn::make('RplNum')
                    ->searchable(),
                Tables\Columns\IconColumn::make('Salduz')
                    ->boolean(),
                Tables\Columns\TextColumn::make('DevRest')
                    ->searchable(),
                Tables\Columns\TextColumn::make('notice_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_created')
                    ->searchable(),
                Tables\Columns\IconColumn::make('Audition')
                    ->boolean(),
                Tables\Columns\IconColumn::make('PrintTrypt')
                    ->boolean(),
                Tables\Columns\TextColumn::make('contention_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bac')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Prohibe')
                    ->searchable(),
                Tables\Columns\TextColumn::make('incident_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('EqCharge')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Avocate')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ProhiValImp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('SurvCam')
                    ->searchable(),
                Tables\Columns\TextColumn::make('medical_id')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListDetainees::route('/'),
            'create' => Pages\CreateDetainee::route('/create'),
            'view' => Pages\ViewDetainee::route('/{record}'),
            'edit' => Pages\EditDetainee::route('/{record}/edit'),
        ];
    }
}
