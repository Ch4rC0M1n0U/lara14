<?php

namespace App\Filament\Resources\DetaineeResource\Pages;

use App\Filament\Resources\DetaineeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetainees extends ListRecords
{
    protected static string $resource = DetaineeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
