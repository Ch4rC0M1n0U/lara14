<?php

namespace App\Filament\Resources;

use App\Models\Cell;
use Filament\Tables;
use App\Models\PrivLib;
use App\Models\Detainee;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\DetaineeResource\Pages;

use App\Models\TrustedContact;
use Filament\Forms\Components\Section;

class DetaineeResource extends Resource
{
    protected static ?string $model = Detainee::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';
    protected static ?string $navigationLabel = 'Détenu(s)';
    protected static ?string $navigationGroup = 'Gestion de la détention';
    protected static ?string $navigationBadgeTooltip = 'Liste des détenu(e)s et gestion';

    protected static ?string $modelLabel = 'Détenu';
    protected static ?string $pluralModelLabel = 'Détenus';




    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }


    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                Section::make('Informations concernant la détention')
                ->description('Veuillez remplir les informations suivantes pour configurer la détention.')
                ->icon('heroicon-s-building-office-2')
                ->schema([
                    TextInput::make('RplNum')
                        ->label('Numéro du Registre de privation de liberté')
                        ->required()
                        ->maxLength(50),
                    Select::make('cell_id')
                        ->label('Cellule')
                        ->live()
                        ->relationship('cell', 'id')
                        ->options(function () {
                            return Cell::where('CellStat', 'Libre')
                            ->where('CellRest', '>', 0)
                            ->selectRaw("CONCAT(CellNum, ' - ', CellType, ' - ', IF(CellMinor = 1, 'Mineur', 'Majeur')) as display, id")
                            ->pluck('display', 'id')
                            ->toArray();
                        })
                        ->required(),
                    Select::make('service_id')
                        ->relationship('service', 'name')
                        ->searchable()
                        ->preload()
                        ->nullable()
                            ->createOptionForm([
                                TextInput::make('name')
                                ->required()
                                ->label('Nom du service ou de l\'unité')
                                ->maxLength(255),
                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                ->required()
                                ->label('Nom du service ou de l\'unité')
                                ->maxLength(255),
                            ]),
                    Select::make('SSType')
                        ->label('Type de situation')
                        ->options(
                            ['Personne malade' => 'Personne malade',
                            'Ivresse publique' => 'Ivresse publique',
                            'Trouble de l\'OP' => 'Trouble de l\'OP',
                            'Rebéllion' => 'Rebéllion',
                            'Maladie Transmissible' => 'Maladie Transmissible',
                            'Antécédents' => 'Antécédents',
                            'E.D.S.' => 'E.D.S.',
                            'Autre' => 'Autre']
                        ),
                    TextInput::make('PlaceRestante')
                        ->live()
                        ->hidden(),
                    Select::make('priv_lib_id')
                        ->label('Durée max. de privation de liberté')
                        ->required()
                        ->relationship('privlib', 'id')
                        ->options(function () {
                            return PrivLib::selectRaw("CONCAT(TypeArrest, ' - ', MaxHour) as display, id")
                            ->pluck('display', 'id')
                            ->toArray();
                        })
                        ->preload(),
                    Select::make('Salduz')
                        ->options(
                            ['A confirmer' => 'A confirmer',
                            'Salduz 3' => 'Salduz 3',
                            'Salduz 4' => 'Salduz 4']
                        )
                        ->required(),

                            ])->columns(2),
                Section::make('Informations concernant le détenu')
                    ->description('Veuillez remplir les informations suivantes pour configurer le détenu.')
                    ->icon('heroicon-s-user')
                    ->schema([
                        TextInput::make('lastname')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('firstname')
                            ->label('Prénom')
                            ->required()
                            ->maxLength(255),
                        DatePicker::make('birthdate')
                            ->label('Date de naissance')
                            ->date('d/m/Y')
                            ->native(false)
                            ->maxDate(now())
                            ->required()
                            ->validationMessages([
                                'maxDate' => 'Vérifier votre date de naissance']),
                        Select::make('sexe')
                            ->options(
                                ['Masculin' => 'Masculin',
                                'Feminin' => 'Feminin',
                                'Non-Binaire' => 'Non-Binaire']
                            )
                            ->required(),
                    ]),

                Select::make('liberation_id')
                    ->label('Libération')
                    ->relationship('Liberation', 'id')
                    ->preload()
                    ->nullable()
                        ->createOptionForm([
                            DateTimePicker::make('name')
                            ->required()
                            ->label('Date et Heure de fin de P.L.')
                            ->native(true)
                            ->default(now()),
                        ])
                        ->editOptionForm([
                            DateTimePicker::make('name')
                            ->required()
                            ->label('Date et Heure de fin de P.L.')
                            ->native(true),
                        ]),
                Select::make('trusted_contact_id')
                    ->label('Contact de confiance')
                    ->relationship('TrustedContact', 'id')
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->options(function () {
                        return TrustedContact::selectRaw("CONCAT(firstname, ' - ', relationType , ' - ', TypeOfContact) as display, id")
                        ->pluck('display', 'id')
                        ->toArray();
                    })
                        ->createOptionForm([
                            TextInput::make('firstname')
                            ->required()
                            ->label('Nom du contact de confiance')
                            ->maxLength(100),
                            TextInput::make('lastname')
                            ->required()
                            ->label('Prénom')
                            ->maxLength(255),
                            TextInput::make('phone')
                            ->required()
                            ->label('Téléphone')
                            ->maxLength(20)
                            ->tel(),
                            TextInput::make('email')
                            ->label('Email')
                            ->maxLength(255)
                            ->email(),
                            Select::make('relationType')
                            ->label('Lien')
                            ->options(
                                ['Conjoint' => 'Conjoint',
                                'Parent' => 'Parent',
                                'Enfant' => 'Enfant',
                                'Ami' => 'Ami',
                                'Connaissance' => 'Connaissance',
                                'Autre' => 'Autre']
                            ),
                            Select::make('TypeOfContact')
                            ->label('Type de contact')
                            ->options(
                                ['Téléphone' => 'Téléphone',
                                'Email' => 'Email',
                                'Visite' => 'Visite',
                                'Verbal' => 'Verbal',
                                'Autre' => 'Autre']
                            ),
                            DateTimePicker::make('contact_DateHour')
                            ->label('Date et Heure de contact')
                            ->date('d/m/Y')
                            ->time('H:i')
                            ->default(now())
                            ->native(true),
                            Toggle::make('contactOk')
                            ->label('Contact établi')
                            ->default(false),
                            Toggle::make('contactRefused')
                            ->label('Contact refusé')
                            ->default(false),
                            Textarea::make('motivation_Refusal')
                            ->rows(10)
                            ->cols(20),
                        ])->editOptionForm([
                            TextInput::make('firstname')
                            ->required()
                            ->label('Nom du contact de confiance')
                            ->maxLength(100),
                            TextInput::make('lastname')
                            ->required()
                            ->label('Prénom')
                            ->maxLength(255),
                            TextInput::make('phone')
                            ->required()
                            ->label('Téléphone')
                            ->maxLength(20)
                            ->tel(),
                            TextInput::make('email')
                            ->label('Email')
                            ->maxLength(255)
                            ->email(),
                            Select::make('relationType')
                            ->label('Lien')
                            ->options(
                                ['Conjoint' => 'Conjoint',
                                'Parent' => 'Parent',
                                'Enfant' => 'Enfant',
                                'Ami' => 'Ami',
                                'Connaissance' => 'Connaissance',
                                'Autre' => 'Autre']
                            ),
                            Select::make('TypeOfContact')
                            ->label('Type de contact')
                            ->options(
                                ['Téléphone' => 'Téléphone',
                                'Email' => 'Email',
                                'Visite' => 'Visite',
                                'Verbal' => 'Verbal',
                                'Autre' => 'Autre']
                            ),
                            DateTimePicker::make('contact_DateHour')
                            ->label('Date et Heure de contact')
                            ->date('d/m/Y')
                            ->time('H:i')
                            ->native(true),
                            Toggle::make('contactOk')
                            ->label('Contact établi')
                            ->default(false),
                            Toggle::make('contactRefused')
                            ->label('Contact refusé')
                            ->default(false),
                            Textarea::make('motivation_Refusal')
                            ->rows(10)
                            ->cols(20),
                        ]),
                Toggle::make('isolement')
                    ->required(),

                TextInput::make('DevRest')
                    ->required()
                    ->maxLength(255),
                TextInput::make('notice_id')
                    ->required()
                    ->numeric(),
                TextInput::make('user_created')
                    ->required()
                    ->default(auth()->user()->name)
                    ->maxLength(255)
                    ->hidden(),
                Toggle::make('Audition')
                    ->required(),
                Toggle::make('PrintTrypt')
                    ->required(),
                TextInput::make('contention_id')
                    ->required()
                    ->numeric(),
                TextInput::make('bac')
                    ->required()
                    ->maxLength(255),
                TextInput::make('Prohibe')
                    ->required()
                    ->maxLength(255),
                TextInput::make('incident_id')
                    ->required()
                    ->numeric(),
                TextInput::make('EqCharge')
                    ->required()
                    ->maxLength(255),
                TextInput::make('Avocate')
                    ->required()
                    ->maxLength(255),
                TextInput::make('ProhiValImp')
                    ->required()
                    ->maxLength(255),
                TextInput::make('SurvCam')
                    ->required()
                    ->maxLength(255),
                TextInput::make('medical_id')
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
