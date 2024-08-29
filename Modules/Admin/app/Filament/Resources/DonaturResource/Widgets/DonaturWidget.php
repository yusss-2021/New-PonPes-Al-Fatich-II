<?php

namespace Modules\Admin\Filament\Resources\DonaturResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Modules\Admin\Models\Donatur;
use Modules\Admin\Models\Payment;

class DonaturWidget extends BaseWidget
{
    protected static bool $isLazy = false;
    protected function getStats(): array
    {
        return [
            'Settlement' => Stat::make('Donatur', Donatur::where('status', 'settlement')->join('payments', 'donaturs.payment_id', '=', 'payments.id')->count())
                ->label('Total Donatur')
                ->color('success')
                ->icon('hugeicons-cashier')
                ->description('Selesai melakukan transaksi'),
            'Cancel' => Stat::make('Donatur', Donatur::where('status', 'cancel')->join('payments', 'donaturs.payment_id', '=', 'payments.id')->count())
                ->label('Total Donatur')
                ->color('danger')
                ->icon('hugeicons-cashier')
                ->description('Membatalkan transaksi'),
            'Pending' => Stat::make('donatur', Donatur::where('status', 'pending')->join('payments', 'donaturs.payment_id', '=', 'payments.id')->count())
                ->label('Total Donatur')
                ->color('warning')
                ->description('Pending transaksi')
                ->icon('hugeicons-cashier')
        ];
    }
}
