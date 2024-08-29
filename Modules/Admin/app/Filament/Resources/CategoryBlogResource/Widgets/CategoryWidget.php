<?php

namespace Modules\Admin\Filament\Resources\CategoryBlogResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CategoryWidget extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';
    protected function getStats(): array
    {
        return [
            'Total' => Stat::make('Category', \Modules\Admin\Models\CategoryBlog::count())
                ->label('')
                ->color('success')
                ->description('Jumlah Kategori')
        ];
    }

    protected function getColumns(): int
    {
        return 1;
    }
}
