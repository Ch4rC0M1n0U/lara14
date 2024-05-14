<?php

namespace App\Filament\Resources\ContentionResource\Pages;

use App\Filament\Resources\ContentionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContention extends EditRecord
{
    protected static string $resource = ContentionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
