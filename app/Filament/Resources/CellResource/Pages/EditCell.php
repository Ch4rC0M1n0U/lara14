<?php

namespace App\Filament\Resources\CellResource\Pages;

use App\Filament\Resources\CellResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCell extends EditRecord
{
    protected static string $resource = CellResource::class;

    protected static ?string $title = 'Edition de cellule';
    protected ?string $heading = 'Edition de cellule';

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
