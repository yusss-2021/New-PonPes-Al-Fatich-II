<?php

namespace Modules\Admin\Filament\Resources\GalleryResource\Pages;

use Modules\Admin\Filament\Resources\GalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGalleries extends ListRecords
{
    protected static string $resource = GalleryResource::class;

    protected static ?string $title = 'Gallery';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Gallery')
                ->icon('fas-plus'),
        ];
    }
}
