<?php

namespace App\Filament\Resources\LiberationResource\Pages;

use App\Filament\Resources\LiberationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLiberation extends EditRecord
{
    protected static string $resource = LiberationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
