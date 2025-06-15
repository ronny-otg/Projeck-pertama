<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $now = Carbon::now();
        $notifications = collect(); // Mulai dengan koleksi notifikasi kosong

        // --- LOGIKA 1: Peringatan Anggaran ---
        $budget = Budget::where('user_id', $user_id)
            ->where('year', $now->year)
            ->where('month', $now->month)
            ->first();

        if ($budget && $budget->amount > 0) {
            $totalSpending = Transaction::where('user_id', $user_id)
                ->where('type', 'pengeluaran')
                ->whereYear('transaction_date', $now->year)
                ->whereMonth('transaction_date', $now->month)
                ->sum('amount');
            
            $percentageUsed = ($totalSpending / $budget->amount) * 100;

            if ($percentageUsed >= 80) {
                // Jika pemakaian lebih dari 80%, buat notifikasi
                $notifications->push((object)[
                    'title' => 'Peringatan: Anggaran Hampir Habis!',
                    'description' => 'Anda telah menggunakan ' . number_format($percentageUsed, 0) . '% dari anggaran bulan ini.',
                    'timestamp' => 'Baru saja',
                    'icon_color' => 'bg-red-100 text-red-600',
                    'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />'
                ]);
            }
        }

        // --- LOGIKA 2: Notifikasi Statis (Contoh) ---
        $notifications->push((object)[
            'title' => 'Laporan Mingguan Tersedia',
            'description' => 'Lihat ringkasan pengeluaran Anda untuk minggu lalu di halaman Laporan.',
            'timestamp' => '1 hari yang lalu',
            'icon_color' => 'bg-sky-100 text-sky-600',
            'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />'
        ]);


        return view('notifications.index', [
            'notifications' => $notifications,
        ]);
    }
}
