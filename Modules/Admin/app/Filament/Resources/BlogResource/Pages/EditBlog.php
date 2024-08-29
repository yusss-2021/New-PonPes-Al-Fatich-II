<?php

namespace Modules\Admin\Filament\Resources\BlogResource\Pages;

use Modules\Admin\Filament\Resources\BlogResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Js;
use Modules\Admin\Models\Blog;

class EditBlog extends EditRecord
{
    protected static string $resource = BlogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Hapus')
                ->modalHeading('Hapus Blog')
                ->modalDescription('Apakah anda yakin ingin menghapus blog ini?')
                ->modalSubmitActionLabel('Ya, Saya yakin')
                ->modalCancelActionLabel('Tidak, Batalkan')
                ->icon('heroicon-o-trash')
                ->before(function (Blog $blog) {
                    if ($blog->attachment) {
                        Storage::disk('public')->delete($blog->attachment);
                    }
                    $imageContent = $blog->content;
                    preg_match('/<img[^>]+src="([^">]+)"/', $imageContent, $matches);
                    $srcUrl = $matches[1];

                    $fileNameWithExtension = basename($srcUrl);

                    $pathToFile = "blogs/content/{$fileNameWithExtension}";

                    // Hapus file
                    if (Storage::disk('public')->exists($pathToFile)) {
                        Storage::disk('public')->delete($pathToFile);
                    }
                }),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if (!empty($data['atachment']) && $data['attachment'] !== $record->attachment) {
            Storage::disk('public')->delete($record->atttachment);
            $record->update([
                'title' => $data['title'],
                'slug' => $data['slug'],
                'attachment' => $data['attachment'],
                'content' => $data['content'],
                'tag' => $data['tag'],
                'category_id' => $data['category_id']
            ]);
            return $record;
        } elseif ($data['content'] !== $record->content) {
            $imageContent = $data['content'];
            $recordContent = $record->content;
            preg_match('/<img[^>]+src="([^">]+)"/', $imageContent, $matches);
            $srcUrl = $matches[1];

            $fileNameWithExtension = basename($srcUrl);
            preg_match('/<img[^>]+src="([^">]+)"/', $recordContent, $match);
            $newSrcUrl = $match[1];
            $recordFileName = basename($newSrcUrl);
            $recordFile = "blogs/content/{$recordFileName}";
            if (Storage::disk('public')->exists("blogs/content/{$fileNameWithExtension}")) {
                Storage::disk('public')->delete($recordFile);
            }
            $record->update([
                'title' => $data['title'],
                'slug' => $data['slug'],
                'attachment' => $data['attachment'],
                'content' => $data['content'],
                'tag' => $data['tag'],
                'category_id' => $data['category_id']
            ]);
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
