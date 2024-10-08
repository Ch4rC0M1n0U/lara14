<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Kenepa\Banner\BannerPlugin;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use SebastianBergmann\Type\FalseType;
use App\Filament\Widgets\UserOverview;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Tapp\FilamentMailLog\FilamentMailLogPlugin;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Okeonline\FilamentArchivable\FilamentArchivablePlugin;
use Bytexr\QueueableBulkActions\QueueableBulkActionsPlugin;
use Edwink\FilamentUserActivity\FilamentUserActivityPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use InvadersXX\FilamentGridstackDashboard\GridstackDashboardPlugin;
use ShuvroRoy\FilamentSpatieLaravelBackup\FilamentSpatieLaravelBackupPlugin;
use DutchCodingCompany\FilamentDeveloperLogins\FilamentDeveloperLoginsPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->authGuard('web')
            ->login()
            ->brandName('Pegasus')
            ->brandLogoHeight('2.0rem')
            ->brandLogo(asset('images/logo.png'))
            ->darkMode(false)
            ->sidebarCollapsibleOnDesktop()
            ->breadcrumbs(true)
            ->favicon(asset('images/favicon.png'))
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->font('Montserrat')
            ->navigationGroups([
                'Gestion de la détention',
                'Gestion des consignes',
                'Configuration',
            ])
            ->colors([
                'danger' => Color::hex('#EF5350'),
                'gray' => Color::hex('#ECEFF1'),
                'info' => Color::hex('#E3F2FD'),
                'primary' => Color::hex('#1565C0'),
                'success' => Color::hex('#8BC34A'),
                'warning' => Color::hex('#FFA726'),
            ])
            //->maxContentWidth(MaxWidth::Full)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->plugins([
                FilamentArchivablePlugin::make(),
                FilamentDeveloperLoginsPlugin::make()
                ->enabled(app()->environment('local'))
                ->switchable(false) // This also accepts a closure.
                ->users([
                    'Admin' => 'admin@police.belgium.eu',
                    'User' => 'hurugur@mailinator.com',
                ]),
                BannerPlugin::make()
                ->persistsBannersInDatabase()
                ->bannerManagerAccessPermission('banner-manager'),
                FilamentMailLogPlugin::make(),
            ])
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                UserOverview::class,
            ])
            ->renderHook(
                // This line tells us where to render it
                'panels::body.end',
                // This is the view that will be rendered
                fn () => view('customFooter'),
            )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])

            ->resources([
                config('filament-logger.activity_resource')
            ])

            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
