<?php

namespace App\Filament\Resources\DetaineeResource\Pages;

use App\Filament\Resources\DetaineeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDetainee extends ViewRecord
{
    protected static string $resource = DetaineeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
