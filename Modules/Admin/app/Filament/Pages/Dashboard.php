<?php

namespace Modules\Admin\Pages;

use Doctrine\DBAL\Schema\View;
use Filament\Facades\Filament;
use Filament\Pages\Page;
use Filament\Support\Facades\FilamentIcon;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\Widget;
use Filament\Widgets\WidgetConfiguration;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\Filament\Resources\BlogResource\Widgets\BlogWidget;
use Modules\Admin\Filament\Resources\WakafResource\Widgets\RaisedAmountWakaf;

class Dashboard extends Page
{
    protected static string $routePath = '/admin';


    protected ?string $heading = 'Dashboard';
    protected static ?int $navigationSort = -2;

    /**
     * @var View string
     */
    protected static string $view = 'filament-panels::pages.dashboard';

    public static function getNavigationLabel(): string
    {
        return static::$navigationLabel ??
            static::$title ??
            __('Dashboard');
    }

    public static function getNavigationIcon(): string | Htmlable | null
    {
        return static::$navigationIcon
            ?? FilamentIcon::resolve('panels::pages.dashboard.navigation-item')
            ?? (Filament::hasTopNavigation() ? 'heroicon-m-home' : 'heroicon-o-home');
    }

    public static function getRoutePath(): string
    {
        return static::$routePath;
    }

    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        return [
            AccountWidget::class,
            RaisedAmountWakaf::class,
            BlogWidget::class,
        ];
    }

    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getVisibleWidgets(): array
    {
        return $this->filterVisibleWidgets($this->getWidgets());
    }


    public function getTitle(): string | Htmlable
    {
        return static::$title ?? __('filament-panels::pages/dashboard.title');
    }

    public function getHeaderWidgetsColumns(): int
    {
        return 1;
    }

    public function getColumns(): int | string | array
    {
        return [
            'md' => 1,
            'xl' => 1,
        ];
    }

    public static function canAccess(): bool
    {
        return Auth::user()->roles->pluck('name')->contains('super_admin');
    }
}
