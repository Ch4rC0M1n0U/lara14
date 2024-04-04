<?php

namespace App\Filament\Resources\CellResource\Pages;

use App\Filament\Resources\CellResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCell extends CreateRecord
{
    protected static string $resource = CellResource::class;

    protected static ?string $title = 'Création de cellule';
    protected ?string $heading = 'Création de cellule';
}
