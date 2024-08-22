<?php

namespace Modules\Admin\Filament\Resources\ProgramResource\Pages;

use Modules\Admin\Filament\Resources\ProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrograms extends ListRecords
{
    protected static string $resource = ProgramResource::class;

    protected static ?string $title = 'Program';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Program')
                ->icon('fas-plus'),
        ];
    }
}
