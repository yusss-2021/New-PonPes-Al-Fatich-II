<?php

namespace Modules\Admin\Filament\Resources\DonaturResource\Pages;

use Modules\Admin\Filament\Resources\DonaturResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDonaturs extends ListRecords
{
    protected static string $resource = DonaturResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            DonaturResource\Widgets\DonaturWidget::class
        ];
    }
}
