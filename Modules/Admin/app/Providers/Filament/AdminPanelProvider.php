<?php

namespace Modules\Admin\Providers\Filament;

use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Coolsam\Modules\ModulesPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Modules\Admin\Filament\Resources\WakafResource\Widgets\RaisedAmountWakaf;
use Modules\Admin\Pages\Dashboard;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('panel')
            ->plugins([
                ModulesPlugin::make(),
                FilamentShieldPlugin::make()
                    ->localizePermissionLabels(true)
            ])

            ->login()
            ->colors([
                'danger' => Color::Red,
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'primary' => Color::Indigo,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Menu Utama')
                    ->collapsible(false),
                NavigationGroup::make()
                    ->label('Keuangan')
                    ->collapsible(false),
                NavigationGroup::make()
                    ->label('CMS')
                    ->collapsible(false),
                NavigationGroup::make()
                    ->label('Hak Akses & User')
                    ->collapsible(false),
            ])
            ->favicon(asset('favicon/favicon.ico'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'Modules\\Admin\\App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'Modules\\Admin\\App\\Filament\\Pages')
            ->pages([
                Dashboard::class
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'Moduls\\Admin\\App\\Filament\\Widgets')

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
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
