<?php

namespace App\Filament\Resources\DetaineeResource\Pages;

use App\Filament\Resources\DetaineeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetainees extends ListRecords
{
    protected static string $resource = DetaineeResource::class;

    protected static ?string $title = 'Gestion des détenus';
    protected ?string $heading = 'Gestion des détenus';
    protected ?string $subheading = 'Gestion et liste des détenus';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
