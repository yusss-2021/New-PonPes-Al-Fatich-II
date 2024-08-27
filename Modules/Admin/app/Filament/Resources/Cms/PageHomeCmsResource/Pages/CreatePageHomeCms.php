<?php

namespace Modules\Admin\Filament\Resources\Cms\PageHomeCmsResource\Pages;

use Modules\Admin\Filament\Resources\Cms\PageHomeCmsResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Js;

class CreatePageHomeCms extends CreateRecord
{
    protected static string $resource = PageHomeCmsResource::class;
    protected static ?string $title = 'Hero Section';
    protected ?string $heading = 'CMS - Tambah Konten Hero Section';

    protected function getCreatedNotification(): Notification
    {

        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('Membuat konten hero section baru')
            ->send();
    }
    protected function getCreateFormAction(): Action
    {

        return Action::make('create')
            ->label('Simpan')
            ->color('success')
            ->icon('fas-paper-plane')
            ->action('create');
    }

    protected function getCreateAnotherFormAction(): Action
    {
        return Action::make('createAnother')
            ->label('Simpan & Buat Baru')
            ->icon('heroicon-o-squares-plus')
            ->color('gray')
            ->action('createAnother');
    }

    protected function getCancelFormaction(): Action
    {

        return Action::make('cancel')
            ->label('Kembali')
            ->color('danger')
            ->icon('zondicon-arrow-left')
            ->alpineClickHandler('document.referrer ? window.history.back() : (window.location.href = ' . Js::from($this->previousUrl ?? static::getResource()::getUrl()) . ')');
    }
}
