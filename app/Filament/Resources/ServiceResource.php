<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Service;
use Filament\Forms\Form;
use Pages\CreateService;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\ServiceResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ServiceResource\RelationManagers;
use Filament\Tables\Columns\IconColumn;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $modelLabel = 'Service';
    protected static ?string $pluralModelLabel = 'Services';

    protected static ?string $navigationLabel = 'Service(s)';
    protected static ?string $navigationGroup = 'Configuration';
    protected static ?string $navigationBadgeTooltip = 'Liste des services et gestion de leurs informations';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getBreadcrumb(): string
    {
        return 'Gestion des Cellules';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make('Informations générales')
                        ->description('Veuillez remplir les informations suivantes pour permettre l\'identification des services ou unités ayant accès pour le placement d\'invididus en détention.')
                        ->icon('heroicon-o-cog')
                        ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->label('Nom du service ou de l\'unité')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('street')
                        ->label('Rue')
                        ->nullable()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('street_number')
                        ->label('N°')
                        ->nullable()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('city')
                        ->label('Ville')
                        ->nullable()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('zip')
                        ->label('Code Postal')
                        ->nullable(),
                    Fieldset::make('Contact')
                        ->schema([
                    Forms\Components\TextInput::make('phone')
                        ->label('Téléphone')
                        ->tel()
                        ->required(),
                    Forms\Components\TextInput::make('email')
                        ->label('Courriel')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('contact')
                        ->label('Personne de référence')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('hierarchy')
                        ->label('Responsable Hiérararchique')
                        ->nullable()
                        ->maxLength(255),
                    ])->columns(1),
                        ]),

                Section::make([
                    Forms\Components\Toggle::make('exterior')
                        ->default(0)
                        ->label('Extérieur')
                        ->hintIcon('heroicon-o-information-circle')
                        ->hintIconTooltip('Ce service est un service extérieure ?')
                        ->hintColor('primary'),
                    Forms\Components\Toggle::make('h24')
                        ->default(0)
                        ->label('Permanence')
                        ->hintIcon('heroicon-o-information-circle')
                        ->hintIconTooltip('Ce service est un service avec une permanence H24 ?')
                        ->hintColor('primary'),
                    ])->grow(false),
                ])->from('md'),
            ])->columns(1);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date de création')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Dernière modification')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom du service ou de l\'unité')
                    ->searchable(),
                Tables\Columns\IconColumn::make('exterior')
                    ->label('Extérieur')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('street')
                    ->label('Rue')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('street_number')
                    ->label('N°')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('city')
                    ->label('Ville')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('zip')
                    ->label('Code Postal')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('phone')
                    ->icon('heroicon-o-phone')
                    ->label('Téléphone')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('email')
                    ->icon('heroicon-o-at-symbol')
                    ->label('Courriel')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),                    
                Tables\Columns\TextColumn::make('contact')
                    ->searchable()
                    ->label('Personne de contact')
                    ->toggleable(isToggledHiddenByDefault: false),                    
                Tables\Columns\TextColumn::make('hierarchy')
                    ->searchable()
                    ->label('Responsable Hiérararchique')
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\IconColumn::make('h24')
                ->boolean()
                ->label('Permanence H24')
                ->color('primary'),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'view' => Pages\ViewService::route('/{record}'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
