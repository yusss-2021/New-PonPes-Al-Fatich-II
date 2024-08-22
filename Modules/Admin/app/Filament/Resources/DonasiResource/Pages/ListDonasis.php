<?php

namespace Modules\Admin\Filament\Resources\DonasiResource\Pages;

use Modules\Admin\Filament\Resources\DonasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDonasis extends ListRecords
{
    protected static string $resource = DonasiResource::class;

    protected static ?string $title = 'Donasi';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Donasi')
                ->icon('fas-plus'),
        ];
    }
}
