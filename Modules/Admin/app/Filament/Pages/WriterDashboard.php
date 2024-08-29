<?php

namespace Modules\Admin\Filament\Pages;

use Filament\Widgets\AccountWidget;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\Filament\Resources\BlogResource\Widgets\BlogWidget;
use Modules\Admin\Filament\Resources\CategoryBlogResource\Widgets\CategoryWidget;
use Modules\Admin\Pages\Dashboard;

class WriterDashboard extends Dashboard
{
    protected static string $routePath = '/dashboard-writer';
    protected static ?string $title = 'Dashboard Penulis';
    public static function canAccess(): bool
    {
        return Auth::user()->roles->pluck('name')->contains('penulis');
    }

    public function getWidgets(): array
    {
        return [
            AccountWidget::class,
            BlogWidget::class,
            CategoryWidget::class,
        ];
    }
}
