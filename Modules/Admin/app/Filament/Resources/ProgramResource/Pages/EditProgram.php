<?php

namespace Modules\Admin\Filament\Resources\ProgramResource\Pages;

use Modules\Admin\Filament\Resources\ProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Models\Program;

class EditProgram extends EditRecord
{
    protected static string $resource = ProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
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

        // $program = Program::find($record->id)->first();

        // if ($data['image'] !== $program->image) {
        //     Storage::disk('public')->delete($program->image);
        //     $record->update($data);
        // } else {
        //     $record->update(
        //         [
        //             'title' => $data['title'],
        //             'description' => $data['description'],
        //             'image' => $program->image
        //         ]
        //     );
        // }



        return $record;
    }
}
