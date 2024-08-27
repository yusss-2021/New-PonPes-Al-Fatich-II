<?php

namespace Modules\Admin\Filament\Resources\Cms\BlogCmsResource\Pages;

use Modules\Admin\Filament\Resources\Cms\BlogCmsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogCms extends ListRecords
{
    protected static string $resource = BlogCmsResource::class;
}
