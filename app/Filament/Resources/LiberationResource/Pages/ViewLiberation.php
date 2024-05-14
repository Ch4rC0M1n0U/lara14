<?php

namespace App\Filament\Resources\LiberationResource\Pages;

use App\Filament\Resources\LiberationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLiberation extends ViewRecord
{
    protected static string $resource = LiberationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
