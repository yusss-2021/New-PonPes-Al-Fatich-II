<?php

namespace Modules\Admin\Filament\Resources\CategoryBlogResource\Pages;

use Modules\Admin\Filament\Resources\CategoryBlogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoryBlogs extends ListRecords
{
    protected static string $resource = CategoryBlogResource::class;

    protected static ?string $title = 'Kategori Blog';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Kategori Blog')
                ->icon('fas-plus'),
        ];
    }
}
