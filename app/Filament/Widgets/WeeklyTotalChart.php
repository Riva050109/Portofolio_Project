<?php



namespace App\Filament\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class WeeklyTotalChart extends ChartWidget
{
    protected static ?string $heading = 'Order Mingguan';

    protected static ?string $pollingInterval = null; // Nonaktifkan auto-refresh jika tidak perlu
    protected static ?int $sort = 2; // Urutan tampil widget

    protected function getData(): array
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        
        // Ambil data order per hari dalam seminggu
        $ordersData = Order::select(
                DB::raw('DAYNAME(created_at) as day_name'),
                DB::raw('DAYOFWEEK(created_at) as day_of_week'),
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(total_amount) as total_revenue')
            )
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('day_name', 'day_of_week')
            ->orderBy('day_of_week')
            ->get();

        // Siapkan array untuk semua hari dalam seminggu
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $orderCounts = [];
        $revenueData = [];
        $labels = [];

        // Isi data untuk setiap hari
        foreach ($daysOfWeek as $index => $day) {
            $dayData = $ordersData->firstWhere('day_name', $day);
            
            $orderCounts[] = $dayData ? $dayData->total_orders : 0;
            $revenueData[] = $dayData ? $dayData->total_revenue : 0;
            $labels[] = Carbon::parse($day)->translatedFormat('D'); // Nama hari singkat
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Order',
                    'data' => $orderCounts,
                    'backgroundColor' => '#4f46e5',
                    'borderColor' => '#4f46e5',
                    'yAxisID' => 'y',
                ],
                [
                    'label' => 'Total Pendapatan (Rp)',
                    'data' => $revenueData,
                    'backgroundColor' => '#10b981',
                    'borderColor' => '#10b981',
                    'type' => 'line',
                    'yAxisID' => 'y1',
                ]
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'scales' => [
                'y' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'left',
                    'title' => [
                        'display' => true,
                        'text' => 'Jumlah Order'
                    ],
                    'beginAtZero' => true,
                ],
                'y1' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'right',
                    'title' => [
                        'display' => true,
                        'text' => 'Pendapatan (Rp)'
                    ],
                    'beginAtZero' => true,
                    'grid' => [
                        'drawOnChartArea' => false,
                    ],
                    'ticks' => [
                        'callback' => 'function(value) { return "Rp " + value.toLocaleString("id-ID"); }'
                    ]
                ],
            ],
            'plugins' => [
                'tooltip' => [
                    'callbacks' => [
                        'label' => 'function(context) { 
                            if (context.datasetIndex === 0) {
                                return context.dataset.label + ": " + context.raw; 
                            } else {
                                return context.dataset.label + ": Rp " + context.raw.toLocaleString("id-ID"); 
                            }
                        }'
                    ]
                ],
                'legend' => [
                    'position' => 'top',
                ],
            ]
        ];
    }

    protected function getEmptyStateDescription(): ?string
    {
        return 'Belum ada data order untuk minggu ini.';
    }

    protected function getEmptyStateIcon(): ?string
    {
        return 'heroicon-o-shopping-bag';
    }
}