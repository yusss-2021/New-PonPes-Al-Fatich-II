<?php

namespace Modules\Admin\Filament\Resources\BlogResource\Pages;

use Modules\Admin\Filament\Resources\BlogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogs extends ListRecords
{
    protected static string $resource = BlogResource::class;

    protected static ?string $title = 'Blog';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Blog')
                ->icon('fas-plus'),
        ];
    }
}
