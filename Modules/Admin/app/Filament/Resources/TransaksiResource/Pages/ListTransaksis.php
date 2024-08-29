<?php

namespace Modules\Admin\Filament\Resources\TransaksiResource\Pages;

use Modules\Admin\Filament\Resources\TransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransaksis extends ListRecords
{
    protected static string $resource = TransaksiResource::class;
    protected static ?string $title = 'Transaksi';
}
