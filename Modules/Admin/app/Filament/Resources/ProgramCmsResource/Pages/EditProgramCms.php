<?php

namespace Modules\Admin\Filament\Resources\ProgramCmsResource\Pages;

use Modules\Admin\Filament\Resources\ProgramCmsResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditProgramCms extends EditRecord
{
    protected static string $resource = ProgramCmsResource::class;

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
            ->url(ProgramCmsResource::getUrl());
    }
}
