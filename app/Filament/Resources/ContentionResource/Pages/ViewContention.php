<?php

namespace App\Filament\Resources\ContentionResource\Pages;

use App\Filament\Resources\ContentionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContention extends ViewRecord
{
    protected static string $resource = ContentionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
