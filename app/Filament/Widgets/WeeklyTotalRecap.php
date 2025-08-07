<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class WeeklyTotalRecap extends BaseWidget
{
    protected function getStats(): array
    {
        // Total order minggu ini
        $weeklyOrders = Order::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();
        
        $lastWeekOrders = Order::whereBetween('created_at', [
            now()->subWeek()->startOfWeek(),
            now()->subWeek()->endOfWeek()
        ])->count();

        $difference = $weeklyOrders - $lastWeekOrders;
        $percentage = $lastWeekOrders > 0 ? ($difference / $lastWeekOrders) * 100 : ($weeklyOrders > 0 ? 100 : 0);

        // Total pendapatan minggu ini
        $weeklyRevenue = Order::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->sum('total_amount');
        
        $lastWeekRevenue = Order::whereBetween('created_at', [
            now()->subWeek()->startOfWeek(),
            now()->subWeek()->endOfWeek()
        ])->sum('total_amount');

        $revenueDifference = $weeklyRevenue - $lastWeekRevenue;
        $revenuePercentage = $lastWeekRevenue > 0 ? ($revenueDifference / $lastWeekRevenue) * 100 : ($weeklyRevenue > 0 ? 100 : 0);

        return [
            Stat::make('Total Order Minggu Ini', $weeklyOrders)
                ->description($percentage >= 0 ? "↑ {$percentage}%" : "↓ {$percentage}%")
                ->descriptionIcon($percentage >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($percentage >= 0 ? 'success' : 'danger'),
                
            Stat::make('Total Pendapatan', 'Rp ' . number_format($weeklyRevenue, 0, ',', '.'))
                ->description($revenuePercentage >= 0 ? "↑ {$revenuePercentage}%" : "↓ {$revenuePercentage}%")
                ->descriptionIcon($revenuePercentage >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($revenuePercentage >= 0 ? 'success' : 'danger'),
                
            Stat::make('Rata-rata Order Harian', number_format($weeklyOrders/7, 1))
                ->description('Perhitungan 7 hari')
                ->color('info'),
                
            Stat::make('Order Tertinggi', 'Rp ' . number_format(
                Order::whereBetween('created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ])->max('total_amount'), 0, ',', '.'))
                ->color('warning'),
        ];
    }
}