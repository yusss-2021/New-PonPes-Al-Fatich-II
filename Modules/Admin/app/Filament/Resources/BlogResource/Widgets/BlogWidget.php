<?php

namespace Modules\Admin\Filament\Resources\BlogResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BlogWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            'All' => Stat::make('Blog', \Modules\Admin\Models\Blog::count())
                ->label('')
                ->color('success')
                ->description('Jumlah Blog Yang Tersedia'),
            'Published' => Stat::make('Blog', \Modules\Admin\Models\Blog::where('published', 'on')->count())
                ->label('')
                ->color('primary')
                ->description('Jumlah Blog Yang Sudah Terbit'),
            'Diunggulkan' => Stat::make('Blog', \Modules\Admin\Models\Blog::where('featured', 'on')->count())
                ->label('')
                ->color('warning')
                ->description('Jumlah Blog Yang Di Prioritaskan'),
        ];
    }
}
