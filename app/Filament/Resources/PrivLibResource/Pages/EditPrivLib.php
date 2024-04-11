<?php

namespace App\Filament\Resources\PrivLibResource\Pages;

use App\Filament\Resources\PrivLibResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrivLib extends EditRecord
{
    protected static string $resource = PrivLibResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
