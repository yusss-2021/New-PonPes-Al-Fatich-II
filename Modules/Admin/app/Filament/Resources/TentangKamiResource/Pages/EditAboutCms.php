<?php

namespace Modules\Admin\Filament\Resources\TentangKamiResource\Pages;

use Modules\Admin\Filament\Resources\TentangKamiResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditTentangKami extends EditRecord
{
    protected static string $resource = TentangKamiResource::class;

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
            ->icon('zondicon-arrow-left')
            ->color('danger')
            ->url(TentangKamiResource::getUrl());
    }

    protected function handleRecordUpdate(\Illuminate\Database\Eloquent\Model $record, array $data): \Illuminate\Database\Eloquent\Model
    {
        if (!empty($data['image']) && $data['image'] !== $record->image) {
            Storage::disk('public')->delete($record->image);
            $record->update([
                'title' => $data['title'],
                'image' => $data['image'],
                'slug' => $data['slug'],
                'description' => $data['description']
            ]);
            return $record;
        }

        $record->update($data);

        return $record;
    }
}
