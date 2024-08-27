<?php

namespace Modules\Admin\Filament\Resources\Cms\WakafCmsResource\Pages;

use Modules\Admin\Filament\Resources\Cms\WakafCmsResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditWakafCms extends EditRecord
{
    protected static string $resource = WakafCmsResource::class;

    protected function getSaveFormAction(): Action
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
            ->url(WakafCmsResource::getUrl());
    }
}
