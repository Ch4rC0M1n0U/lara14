<?php

namespace App\Filament\Resources\LiberationResource\Pages;

use App\Filament\Resources\LiberationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLiberations extends ListRecords
{
    protected static string $resource = LiberationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
