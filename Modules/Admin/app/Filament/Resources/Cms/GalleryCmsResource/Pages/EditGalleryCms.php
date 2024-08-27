<?php

namespace Modules\Admin\Filament\Resources\Cms\GalleryCmsResource\Pages;

use Modules\Admin\Filament\Resources\Cms\GalleryCmsResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditGalleryCms extends EditRecord
{
    protected static string $resource = GalleryCmsResource::class;

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
            ->url(GalleryCmsResource::getUrl());
    }
}
