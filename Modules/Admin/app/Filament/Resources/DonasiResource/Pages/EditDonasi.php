<?php

namespace Modules\Admin\Filament\Resources\DonasiResource\Pages;

use Modules\Admin\Filament\Resources\DonasiResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Js;
use Modules\Admin\Models\Donasi;

class EditDonasi extends EditRecord
{
    protected static string $resource = DonasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Hapus')
                ->modalHeading('Hapus Donasi')
                ->modalDescription('Apakah anda yakin ingin menghapus donasi ini?')
                ->modalSubmitActionLabel('Ya, Saya yakin')
                ->modalCancelActionLabel('Tidak, Batalkan')
                ->icon('heroicon-o-trash')
                ->before(function (Donasi $donasi) {
                    if (isset($donasi->image)) {
                        Storage::disk('public')->delete($donasi->image);
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
                'image' => $data['image']
            ]);
            return $record;
        }

        $record->update($data);

        return $record;
    }

    protected function getSaveFormAction(): Action
    {
        return Action::make('save')
            ->label('Simpan')
            ->color('success')
            ->submit('save')
            ->icon('fas-paper-plane');
    }

    protected function getCancelFormAction(): Action
    {

        return Action::make('cancel')
            ->label('Kembali')
            ->color('gray')
            ->alpineClickHandler('document.referrer ? window.history.back() : (window.location.href = ' . Js::from($this->previousUrl ?? static::getResource()::getUrl()) . ')')
            ->icon('zondicon-arrow-left');
    }
}