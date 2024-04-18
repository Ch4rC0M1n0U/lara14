<?php

namespace App\Filament\Resources\CellResource\Widgets;

use App\Models\Cell;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CellOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Cellules', Cell::count())
            ->description('Nombre total de cellules enregistrés')
            ->icon('heroicon-o-user'),
        ];
    }
}
