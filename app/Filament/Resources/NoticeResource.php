<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Notice;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\NoticeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NoticeResource\RelationManagers;

class NoticeResource extends Resource
{
    protected static ?string $model = Notice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DateTimePicker::make('Notice_DateHour')
                ->required()
                ->label('Date et Heure de fin de l\'avis')
                ->native(false)
                ->date('d/m/Y')
                ->time('H:i')
                ->default(now()),
                TextInput::make('person_noticed')
                ->label('Personne avisée')
                ->required()
                ->maxLength(255),
                Select::make('typePerson')
                ->label('Type de personne avisée')
                ->options(
                    ['Magistrat' => 'Magistrat',
                    'OPA/OPJ' => 'OPA/OPJ',
                    'O.E.' => 'O.E.',
                    'Autre' => 'Autre']
                )
                ->required(),
                Select::make('Canal_Notice')
                ->label('Canal utilisé')
                ->options(
                    ['Téléphone' => 'Téléphone',
                    'Email' => 'Email',
                    'Visite' => 'Visite',
                    'Verbalement' => 'Verbalement',
                    'Autre' => 'Autre']
                )
                ->required(),
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
                Tables\Columns\TextColumn::make('person_noticed')
                    ->searchable(),
                Tables\Columns\TextColumn::make('typePerson')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Notice_DateHour')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Canal_Notice')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListNotices::route('/'),
            //'create' => Pages\CreateNotice::route('/create'),
            //'view' => Pages\ViewNotice::route('/{record}'),
            //'edit' => Pages\EditNotice::route('/{record}/edit'),
        ];
    }
    
}
