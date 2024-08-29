<?php

namespace Modules\Admin\Filament\Resources\BlogCmsResource\Pages;

use Modules\Admin\Filament\Resources\BlogCmsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBlogCms extends CreateRecord
{
    protected static string $resource = BlogCmsResource::class;
}
