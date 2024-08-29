<?php

namespace Modules\Admin\Filament\Resources\PageHomeCmsResource\Pages;

use Modules\Admin\Filament\Resources\PageHomeCmsResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Js;
use Modules\Admin\Models\PageHomeCms;

class EditPageHomeCms extends EditRecord
{
    protected static string $resource = PageHomeCmsResource::class;

    protected ?string $heading = 'CMS - Edit Konten Hero Section';
    protected static ?string $title = 'Hero Section';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Hapus')
                ->modalHeading('Hapus Konten')
                ->modalDescription('Apakah anda yakin ingin menghapus konten ini?')
                ->modalSubmitActionLabel('Ya, Saya yakin')
                ->modalCancelActionLabel('Tidak, Batalkan')
                ->icon('heroicon-o-trash')
                ->before(function (PageHomeCms $pageHomeCms) {
                    if (Storage::disk('public')->exists($pageHomeCms->image)) {
                        Storage::disk('public')->delete($pageHomeCms->image);
                    }
                }),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if (!empty($data['image']) && $data['image'] !== $record->image) {
            Storage::disk('public')->delete($record->image);
            $record->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'image' => $data['image'],
                'cta' => $data['cta']
            ]);
            return $record;
        }

        $record->update($data);

        return $record;
    }

    protected function getSavedNotification(): Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('Update konten hero section')
            ->send();
    }

    protected function getSaveFormAction(): Action
    {
        return  Action::make('save')
            ->label('Simpan')
            ->color('success')
            ->icon('fas-paper-plane')
            ->submit('save');
    }

    protected function getCancelFormAction(): Action
    {
        return Action::make('cancel')
            ->label('Kembali')
            ->icon('zondicon-arrow-left')
            ->color('gray')
            ->alpineClickHandler('document.referrer ? window.history.back() : (window.location.href = ' . Js::from($this->previousUrl ?? static::getResource()::getUrl()) . ')');
    }
}
