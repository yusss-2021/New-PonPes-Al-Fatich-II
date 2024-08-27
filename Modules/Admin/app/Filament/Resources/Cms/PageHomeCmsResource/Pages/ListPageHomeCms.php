<?php

namespace Modules\Admin\Filament\Resources\Cms\PageHomeCmsResource\Pages;

use Modules\Admin\Filament\Resources\Cms\PageHomeCmsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPageHomeCms extends ListRecords
{
    protected static string $resource = PageHomeCmsResource::class;

    protected static ?string $title = 'CMS - Hero Section';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Konten')
                ->icon('fas-plus'),
        ];
    }
}
