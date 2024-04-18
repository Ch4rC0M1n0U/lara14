<?php

namespace App\Filament\Widgets;

use App\Models\Cell;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class CellOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Cellules', Cell::count())
            ->description('Nombre total de cellules enregistrés')
            ->descriptionIcon('heroicon-o-table-cells', IconPosition::Before),
        ];
    }
}
