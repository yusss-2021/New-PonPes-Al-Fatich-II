<?php

namespace Modules\Admin\Filament\Resources\ProgramResource\Pages;

use Filament\Actions;
use Illuminate\Support\Js;
use Filament\Actions\Action;
use Modules\Admin\Models\Program;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Resources\Pages\EditRecord;
use Modules\Admin\Filament\Resources\ProgramResource;

class EditProgram extends EditRecord
{
    protected static string $resource = ProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Hapus')
                ->modalHeading('Hapus Program')
                ->modalDescription('Apakah anda yakin ingin menghapus program ini?')
                ->modalSubmitActionLabel('Ya, Saya yakin')
                ->modalCancelActionLabel('Tidak, Batalkan')
                ->before(function (Program $program) {
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
                'image' => $record->image
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
