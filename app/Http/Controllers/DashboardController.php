<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // --- MENGAMBIL DATA DARI DATABASE ---
        $pemasukan = Transaction::where('user_id', $user->id)->where('type', 'pemasukan')->sum('amount');
        $pengeluaran = Transaction::where('user_id', $user->id)->where('type', 'pengeluaran')->sum('amount');
        $saldo = $pemasukan - $pengeluaran;
        
        $groupedTransactions = Transaction::where('user_id', $user->id)
                                           ->latest('transaction_date')
                                           ->get()
                                           ->groupBy(function($transaction) {
                                               return Carbon::parse($transaction->transaction_date)->format('Y-m-d');
                                           });
        
        // Kirim data sungguhan ini ke view
        return view('dashboard-mobile', [
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'saldo' => $saldo,
            'groupedTransactions' => $groupedTransactions,
        ]);
    }
}
