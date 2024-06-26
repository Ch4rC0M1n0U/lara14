<?php

namespace App\Filament\Resources\CellResource\Pages;

use App\Filament\Resources\CellResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCells extends ListRecords
{
    protected static string $resource = CellResource::class;

    protected static ?string $title = 'Listing des cellules';
    protected ?string $heading = 'Listing des cellules';
    protected ?string $subheading = 'Liste des cellules existantes dans le complexe pénitentiaire et leurs configurations.';
    protected static ?string $navigationLabel = 'Cellules';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus'),
        ];
    }
}
