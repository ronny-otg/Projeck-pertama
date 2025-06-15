<?php

namespace App\Http\Controllers;

use App\Models\Transaction; // <-- Menggunakan Model sungguhan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $now = Carbon::now();

        // --- MENGAMBIL DATA DARI DATABASE ---

        // 1. Total Pemasukan & Pengeluaran Bulan Ini
        $totalPemasukanBulanIni = Transaction::where('user_id', $user_id)
            ->where('type', 'pemasukan')
            ->whereYear('transaction_date', $now->year)
            ->whereMonth('transaction_date', $now->month)
            ->sum('amount');

        $totalPengeluaranBulanIni = Transaction::where('user_id', $user_id)
            ->where('type', 'pengeluaran')
            ->whereYear('transaction_date', $now->year)
            ->whereMonth('transaction_date', $now->month)
            ->sum('amount');

        // 2. Data untuk Grafik Pengeluaran 7 Hari Terakhir
        $pengeluaranHarian = Transaction::where('user_id', $user_id)
            ->where('type', 'pengeluaran')
            ->where('transaction_date', '>=', $now->copy()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get([
                DB::raw('DATE(transaction_date) as date'),
                DB::raw('SUM(amount) as total')
            ])
            ->keyBy('date');

        // 3. Siapkan data untuk 7 hari di grafik
        $dataGrafik = [];
        $maxSpending = $pengeluaranHarian->max('total') > 0 ? $pengeluaranHarian->max('total') : 1;

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = $now->copy()->subDays($i)->format('Y-m-d');
            $total = $pengeluaranHarian->get($tanggal)->total ?? 0;
            
            $heightPercentage = ($total / $maxSpending) * 100;
            
            $dataGrafik[] = [
                'label' => $now->copy()->subDays($i)->isoFormat('dd'),
                'total' => $total,
                'height' => $heightPercentage > 0 ? max(1, $heightPercentage) : 0 
            ];
        }

        // Kirim semua data sungguhan ini ke view
        return view('reports.index', [
            'totalPemasukan' => $totalPemasukanBulanIni,
            'totalPengeluaran' => $totalPengeluaranBulanIni,
            'dataGrafik' => $dataGrafik,
        ]);
    }
}
