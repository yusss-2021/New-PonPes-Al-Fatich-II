<?php

namespace Modules\Admin\Filament\Resources\ProgramResource\Pages;

use Modules\Admin\Filament\Resources\ProgramResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Js;

class CreateProgram extends CreateRecord
{
    protected static string $resource = ProgramResource::class;

    protected static ?string $title = "Buat Program";
    protected ?string $heading = 'Buat Program Baru';

    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label('Simpan')
            ->color('success')
            ->action('create')
            ->icon('fas-paper-plane');
    }
    protected function getCreateAnotherFormAction(): Action
    {
        return Action::make('createAnother')
            ->label('Simpan & Buat Baru')
            ->color('gray')
            ->icon('heroicon-o-squares-plus');
    }

    protected function getCancelFormAction(): Action
    {

        return Action::make('cancel')
            ->label('Kembali')
            ->color('danger')
            ->alpineClickHandler('document.referrer ? window.history.back() : (window.location.href = ' . Js::from($this->previousUrl ?? static::getResource()::getUrl()) . ')')
            ->icon('zondicon-arrow-left');
    }
}
