<?php

namespace Modules\Admin\Filament\Resources\AboutCmsResource\Pages;

use Modules\Admin\Filament\Resources\AboutCmsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutCms extends ListRecords
{
    protected static string $resource = AboutCmsResource::class;
    protected static ?string $title = "Tentang Kami";
    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
