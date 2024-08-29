<?php

namespace Modules\Admin\Filament\Resources\WakafResource\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class RaisedAmountWakaf extends ChartWidget
{
    protected static ?string $heading = 'Total Pendapatan Wakaf';
    protected static string $color = 'success';

    protected function getData(): array
    {
        $bulanIndonesia = [
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'Mei',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Agu',
            '09' => 'Sep',
            '10' => 'Okt',
            '11' => 'Nov',
            '12' => 'Des',
        ];
        $monthlyAmounts = DB::table('payments')
            ->join('donaturs', 'payments.id', '=', 'donaturs.payment_id')
            ->select(
                DB::raw('SUM(payments.amount) as total_amount'),
                DB::raw("strftime('%m', payments.created_at) as month")
            )
            ->groupBy(DB::raw("strftime('%m', payments.created_at)"))
            ->orderBy(DB::raw("strftime('%m', payments.created_at)"))
            ->get();
        $monthlyAmounts = $monthlyAmounts->mapWithKeys(function ($item) use ($bulanIndonesia) {
            return [$item->month => [
                'total_amount' => $item->total_amount,
                'bulan_indonesia' => $bulanIndonesia[$item->month],
            ]];
        });

        // Menambahkan bulan yang tidak memiliki data
        $allMonths = collect($bulanIndonesia)->map(function ($namaBulan, $kodeBulan) use ($monthlyAmounts) {
            return [
                'bulan_indonesia' => $namaBulan,
                'total_amount' => $monthlyAmounts[$kodeBulan]['total_amount'] ?? 0,
            ];
        });

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Wakaf',
                    'data' => $allMonths->pluck('total_amount')->toArray(),
                ]
            ],
            'labels' => $allMonths->pluck('bulan_indonesia')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
