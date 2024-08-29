<?php

namespace Modules\Admin\Filament\Resources\WakafResource\Pages;

use Modules\Admin\Filament\Resources\WakafResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Js;
use Modules\Admin\Models\Wakaf;

class EditWakaf extends EditRecord
{
    protected static string $resource = WakafResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Hapus')
                ->modalHeading('Hapus Wakaf')
                ->modalDescription('Apakah anda yakin ingin menghapus Wakaf ini?')
                ->modalSubmitActionLabel('Ya, Saya yakin')
                ->modalCancelActionLabel('Tidak, Batalkan')
                ->before(function (Wakaf $program) {
                    if (isset($program->image)) {
                        Storage::disk('public')->delete($program->image);
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
                'target_amount' => $data['target_amount'],
                'end_date' => $data['end_date'],
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
