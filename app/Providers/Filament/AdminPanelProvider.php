<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use App\Filament\Widgets\UserOverview;
use Filament\Http\Middleware\Authenticate;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Illuminate\Session\Middleware\StartSession;
use Tapp\FilamentMailLog\FilamentMailLogPlugin;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Bytexr\QueueableBulkActions\QueueableBulkActionsPlugin;
use Edwink\FilamentUserActivity\FilamentUserActivityPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use InvadersXX\FilamentGridstackDashboard\GridstackDashboardPlugin;
use Tapp\FilamentAuthenticationLog\FilamentAuthenticationLogPlugin;
use ShuvroRoy\FilamentSpatieLaravelBackup\FilamentSpatieLaravelBackupPlugin;
use DutchCodingCompany\FilamentDeveloperLogins\FilamentDeveloperLoginsPlugin;
use SebastianBergmann\Type\FalseType;

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
                FilamentDeveloperLoginsPlugin::make()
                ->enabled(app()->environment('local'))
                ->switchable(false) // This also accepts a closure.
                ->users([
                    'Admin' => 'admin@police.belgium.eu',
                    'User' => 'hurugur@mailinator.com',
                ]),
                FilamentAuthenticationLogPlugin::make(),
                FilamentMailLogPlugin::make(),
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                BreezyCore::make()
                ->avatarUploadComponent(fn ($fileUpload) => $fileUpload->disableLabel())
                ->enableTwoFactorAuthentication(
                    force: false, // force the user to enable 2FA before they can use the application (default = false)
                )
                ->myProfile(
                    shouldRegisterUserMenu: true, // Sets the 'account' link in the panel User Menu (default = true)
                    shouldRegisterNavigation: false, // Adds a main navigation item for the My Profile page (default = false)
                    navigationGroup: 'Settings', // Sets the navigation group for the My Profile page (default = null)
                    hasAvatars: true, // Enables the avatar upload form component (default = false)
                    slug: 'my-profile' // Sets the slug for the profile page (default = 'my-profile')
                ),
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
