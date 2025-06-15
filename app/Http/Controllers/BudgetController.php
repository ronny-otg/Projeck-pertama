<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BudgetController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $now = Carbon::now();

        // 1. Ambil Anggaran Bulan Ini dari Database
        $budget = Budget::where('user_id', $user_id)
            ->where('year', $now->year)
            ->where('month', $now->month)
            ->first();
        
        $budgetAmount = $budget->amount ?? 0;

        // 2. Hitung Total Pengeluaran Bulan Ini dari Tabel Transaksi
        $totalSpending = Transaction::where('user_id', $user_id)
            ->where('type', 'pengeluaran')
            ->whereYear('transaction_date', $now->year)
            ->whereMonth('transaction_date', $now->month)
            ->sum('amount');
        
        $remainingAmount = $budgetAmount - $totalSpending;
        $percentageUsed = $budgetAmount > 0 ? ($totalSpending / $budgetAmount) * 100 : 0;

        // 3. Ambil Rincian Pengeluaran per Kategori
        $spendingByCategory = Transaction::where('user_id', $user_id)
            ->where('type', 'pengeluaran')
            ->whereYear('transaction_date', $now->year)
            ->whereMonth('transaction_date', $now->month)
            ->select('category', DB::raw('SUM(amount) as total'))
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();

        return view('budgets.index', [
            'budgetAmount' => $budgetAmount,
            'totalSpending' => $totalSpending,
            'remainingAmount' => $remainingAmount,
            'percentageUsed' => $percentageUsed,
            'spendingByCategory' => $spendingByCategory,
        ]);
    }

    /**
     * Menyimpan atau memperbarui anggaran untuk bulan ini.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $now = Carbon::now();

        // updateOrCreate akan membuat budget baru jika belum ada, atau memperbaruinya jika sudah ada.
        Budget::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'year' => $now->year,
                'month' => $now->month,
            ],
            [
                'amount' => $request->amount,
            ]
        );

        return redirect()->route('budgets.index');
    }
}
