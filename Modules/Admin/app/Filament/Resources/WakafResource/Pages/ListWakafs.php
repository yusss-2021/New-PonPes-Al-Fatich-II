<?php

namespace Modules\Admin\Filament\Resources\WakafResource\Pages;

use Modules\Admin\Filament\Resources\WakafResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWakafs extends ListRecords
{
    protected static string $resource = WakafResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
