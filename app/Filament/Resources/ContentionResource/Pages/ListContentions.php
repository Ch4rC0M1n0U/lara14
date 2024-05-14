<?php

namespace App\Filament\Resources\ContentionResource\Pages;

use App\Filament\Resources\ContentionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContentions extends ListRecords
{
    protected static string $resource = ContentionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
