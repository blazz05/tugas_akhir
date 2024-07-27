<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Dashboard;
use App\Models\Mahasantri;
use App\Models\Setoran;
use App\Models\Tasmi;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          // Menghitung jumlah mahasantri
          $totalMahasantri = Mahasantri::count();

          // Menghitung jumlah setoran
          $totalSetoran = Setoran::count();
  
          // Menghitung jumlah ujian tahfizh
          $totalTasmi = Tasmi::count();
  
          // Menghitung jumlah user
          $totalUsers = User::count();
  
          // Mengambil data setoran harian (contoh)
          $daily_setoran = Setoran::whereDate('tanggal', now())->get();
  
          // Mengambil data setoran bulanan (contoh)
          $monthly_setoran = Setoran::whereMonth('tanggal', now()->month)->get();

        // Ambil data setoran harian (contoh)
        $dailyChartData = $this->getDailyChartData();

        // Ambil data setoran bulanan (contoh)
        $monthlyChartData = $this->getMonthlyChartData();

        // Query untuk mendapatkan setoran harian
        $daily_setoran = DB::table('setoran')
            ->join('mahasantri', 'mahasantri.id', '=', 'setoran.mahasantri_id')
            ->select('setoran.*', 'mahasantri.nim AS nim', 'mahasantri.nama AS nama')
            ->whereDate('setoran.tanggal', '=', now()->toDateString())
            ->get();

        // Query untuk mendapatkan setoran bulanan
        $monthly_setoran = DB::table('setoran')
            ->join('mahasantri', 'mahasantri.id', '=', 'setoran.mahasantri_id')
            ->select('setoran.*', 'mahasantri.nim AS nim', 'mahasantri.nama AS nama')
            ->whereMonth('setoran.tanggal', '=', now()->month)
            ->whereYear('setoran.tanggal', '=', now()->year)
            ->get();

        // Mengembalikan view dashboard dengan menyertakan data $daily_setoran dan $monthly_setoran
        return view('dashboard', [
            'totalMahasantri' => $totalMahasantri,
            'totalSetoran' => $totalSetoran,
            'totalTasmi' => $totalTasmi,
            'totalUsers' => $totalUsers,
            'daily_setoran' => $daily_setoran,
            'monthly_setoran' => $monthly_setoran,
            'dailyChartData' => $dailyChartData,
            'monthlyChartData' => $monthlyChartData,
        ]);
    }

    private function getDailyChartData()
    {
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']; // Contoh data hari
        $data = []; // Inisialisasi array untuk data setiap hari

        // Simulasi data setoran harian
        foreach ($days as $day) {
            // Generate data setoran acak untuk setiap hari
            $data[] = rand(1, 10); // Data setoran acak, bisa diganti dengan data sesuai query Anda
        }

        return [
            'labels' => $days,
            'data' => $data,
        ];
    }

    /**
     * Contoh fungsi untuk mendapatkan data setoran bulanan
     */
    private function getMonthlyChartData()
    {
        // Simulasi data setoran bulanan
        $dailyTotal = Setoran::whereDate('tanggal', now())->count();
        $monthlyTotal = Setoran::whereMonth('tanggal', now()->month)->count();
        $total = $dailyTotal + $monthlyTotal;

        return [
            'labels' => ['Harian', 'Bulanan'],
            'data' => [
                round(($dailyTotal / $total) * 100, 2), // Hitung persentase setoran harian
                round(($monthlyTotal / $total) * 100, 2), // Hitung persentase setoran bulanan
            ],
        ];
    }
}

