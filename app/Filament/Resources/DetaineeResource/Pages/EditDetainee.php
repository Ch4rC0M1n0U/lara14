<?php

namespace App\Filament\Resources\DetaineeResource\Pages;

use App\Filament\Resources\DetaineeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDetainee extends EditRecord
{
    protected static string $resource = DetaineeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
