<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:pemasukan,pengeluaran',
            'category' => 'required|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        // 2. Simpan data ke database
        Transaction::create([
            'user_id' => Auth::id(), // Ambil ID user yang sedang login
            'amount' => $request->amount,
            'type' => $request->type,
            'category' => $request->category,
            'transaction_date' => $request->transaction_date,
        ]);

        // 3. Kembali ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil disimpan!');
    }
}
