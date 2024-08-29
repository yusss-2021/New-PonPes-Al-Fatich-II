<?php

namespace Modules\Admin\Filament\Resources\BlogCmsResource\Pages;

use Modules\Admin\Filament\Resources\BlogCmsResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EditBlogCms extends EditRecord
{
    protected static string $resource = BlogCmsResource::class;

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
            ->icon('fas-paper-plane')
            ->submit('save');
    }

    protected function getCancelFormAction(): Action
    {
        return Action::make('cancel')
            ->label('Kembali')
            ->color('danger')
            ->icon('zondicon-arrow-left')
            ->url(BlogCmsResource::getUrl());
    }
}
