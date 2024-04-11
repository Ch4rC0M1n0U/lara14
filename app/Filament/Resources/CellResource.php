<?php

namespace App\Filament\Resources;

use App\Models\Cell;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use App\Filament\Resources\CellResource\Pages;

class CellResource extends Resource
{
    protected static ?string $model = Cell::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $modelLabel = 'Cellule';
    protected static ?string $pluralModelLabel = 'Cellules';

    protected static ?string $navigationLabel = 'Cellule(s)';
    protected static ?string $navigationGroup = 'Configuration';
    protected static ?string $navigationBadgeTooltip = 'Liste des cellules et gestion';

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
                        Section::make('Configuration de la cellule')
                        ->description('Veuillez remplir les informations suivantes pour configurer la cellule.')
                        ->icon('heroicon-o-adjustments-vertical')
                        ->schema([
                            TextInput::make('CellNum')
                                ->label('Numéro de cellule')
                                ->live()
                                ->readOnly()
                                ->default(function (Cell $latestCell) {
                                    $latestCell = Cell::latest()->first();
                                    return $latestCell ? $latestCell->CellNum + 1 : 1;
                                }),
                            Select::make('CellType')
                                ->label('Type de cellule')
                                ->options(
                                    [
                                        'Normale' => 'Normale',
                                        'Renforcée' => 'Renforcée',
                                        'Collective' => 'Collective',
                                        'Stockage' => 'Stockage',
                                    ]
                                )
                                ->required(),
                            TextInput::make('CellMax')
                                ->label('Nombre de places')
                                ->default(1)
                                ->live()
                                ->required()
                                ->numeric(),
                            Hidden::make('CellRest')
                            ->default(fn(Get $get): int => $get('CellMax')),
                        ]),
                        Section::make([
                            Toggle::make('CellMinor')
                                ->label('Cellule mineure')
                                ->required(),
                            Select::make('CellStat')
                                ->label('Statut de la cellule')
                                ->default('Libre')
                                ->options([
                                    'Libre' => 'Libre',
                                    'Occupée' => 'Occupée',
                                    'En nettoyage' => 'En nettoyage',
                                    'En réparation' => 'En réparation',
                                    'Hors service' => 'Hors service'
                                ])
                                ->required()
                                ->hiddenOn('edit'),
                        ])->grow(false),
                    ])->from('md'),
                ])->columns(1)
                ;
                
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('CellNum')
                    ->label('Cellule')
                    ->numeric()
                    ->width('1%')
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
                    ->width('1%')
                    ->alignEnd()
                    ->label('Minorité'),
                Tables\Columns\TextColumn::make('CellStat')
                    ->sortable()
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Libre' => 'success',
                        'Occupée' => 'danger',
                        'En nettoyage' => 'primary',
                        'En réparation' => 'warning',
                        'Hors service' => 'gray',
                        default => 'gray', // cas par défaut
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'Libre' => 'heroicon-o-check',
                        'Occupée' => 'heroicon-o-no-symbol',
                        'En nettoyage' => 'heroicon-o-truck',
                        'En réparation' => 'heroicon-o-light-bulb',
                        'Hors service' => 'heroicon-o-x-circle',
                        default => 'heroicon-o-question-mark-circle', // cas par défaut
                    }),

            ])

            ->filters([
                    //
            ])
            ->actions([
                    ActionGroup::make([
                        ViewAction::make(),
                        EditAction::make(),
                        Action::make('ModStat')
                        ->label('Modification de statut')
                        ->icon('heroicon-o-arrow-left-circle')
                        ->color('warning')
                        ->form([
                            Select::make('CellStat')
                                ->label('Statut de la cellule')
                                ->options([
                                    'Libre' => 'Libre',
                                    'Occupée' => 'Occupée',
                                    'En nettoyage' => 'En nettoyage',
                                    'En réparation' => 'En réparation',
                                    'Hors service' => 'Hors service'
                                ])
                                ->default(function (Cell $record) {
                                    return $record->CellStat;
                                })
                        ])
                        ->action(function (Cell $record, array $data): void {
                            $record->CellStat = $data['CellStat'];
                            $record->save();

                            Notification::make()
                                ->title('Le statut de la cellule a été modifié avec succès.')
                                ->success()
                                ->send();

                        }),
                        DeleteAction::make()
                        ->requiresConfirmation(),

                    ])
                    ->button()
                    ->color('primary')
                    ->size(ActionSize::Small),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                ])->button()
                ->color('primary')
                ->size(ActionSize::Small),

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
            //'create' => Pages\CreateCell::route('/create'),
            //'view' => Pages\ViewCell::route('/{record}'),
            //'edit' => Pages\EditCell::route('/{record}/edit'),
        ];
    }
}
