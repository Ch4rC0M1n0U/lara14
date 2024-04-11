<?php

namespace App\Filament\Resources\PrivLibResource\Pages;

use App\Filament\Resources\PrivLibResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPrivLib extends ViewRecord
{
    protected static string $resource = PrivLibResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
