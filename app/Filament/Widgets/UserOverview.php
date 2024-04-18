<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class UserOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $connectedUsers = DB::table('sessions')->count();

        return [
            Stat::make('Utilisateurs', User::count())
            ->description('Nombre total d\'utilisateurs enregistrés')
            ->descriptionIcon('heroicon-o-user', IconPosition::Before),
            Stat::make('Utilisateurs connectés', $connectedUsers)
            ->description('Nombre total d\'utilisateurs connectés')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
        ];
    }
}
