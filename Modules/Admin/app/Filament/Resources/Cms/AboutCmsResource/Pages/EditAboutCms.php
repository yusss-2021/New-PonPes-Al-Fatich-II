<?php

namespace Modules\Admin\Filament\Resources\Cms\AboutCmsResource\Pages;

use Modules\Admin\Filament\Resources\Cms\AboutCmsResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Js;

class EditAboutCms extends EditRecord
{
    protected static string $resource = AboutCmsResource::class;
    protected static ?string $title = 'Edit - Tentang Kami';

    protected function getSaveFormAction(): Actions\Action
    {
        return Action::make('save')
            ->label('Simpan')
            ->color('success')
            ->icon('fas-paper-plane')
            ->submit('save');
    }

    protected function getCancelFormAction(): Action
    {
        return Action::make('cancel')
            ->label('Kembali')
            ->color('danger')
            ->icon('zondicon-arrow-left')
            ->alpineClickHandler('document.referrer ? window.history.back() : (window.location.href = ' . Js::from($this->previousUrl ?? static::getResource()::getUrl()) . ')');
    }
}
