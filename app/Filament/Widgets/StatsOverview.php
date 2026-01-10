<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Movie;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number; // Helper format angka

class StatsOverview extends BaseWidget
{
    // Agar widget ini refresh otomatis tiap 15 detik (biar kelihatan live)
    protected static ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        // 1. Hitung Total Pemasukan (Hanya yang status 'paid')
        $totalRevenue = Booking::where('status', 'paid')->sum('total_price');

        // 2. Hitung Total Tiket Terjual (Hanya yang status 'paid')
        $totalTickets = Booking::where('status', 'paid')->sum('total_tickets');

        // 3. Hitung Jumlah Film Sedang Tayang
        $activeMovies = Movie::where('status', 'now_playing')->count();

        return [
            // KARTU 1: PENDAPATAN
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Pemasukan kotor')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17]) // Grafik hiasan pura-pura
                ->color('success'), // Warna Hijau

            // KARTU 2: TIKET TERJUAL
            Stat::make('Tiket Terjual', $totalTickets)
                ->description('Kursi terisi')
                ->descriptionIcon('heroicon-m-ticket')
                ->color('warning'), // Warna Kuning/Oranye

            // KARTU 3: FILM TAYANG
            Stat::make('Film Sedang Tayang', $activeMovies)
                ->description('Judul film aktif')
                ->descriptionIcon('heroicon-m-film')
                ->color('info'), // Warna Biru
        ];
    }
}