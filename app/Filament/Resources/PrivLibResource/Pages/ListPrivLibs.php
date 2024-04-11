<?php

namespace App\Filament\Resources\PrivLibResource\Pages;

use App\Filament\Resources\PrivLibResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrivLibs extends ListRecords
{
    protected static string $resource = PrivLibResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
