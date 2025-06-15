<?php

namespace App\Http\Controllers;

use App\Models\Wallet; // <-- Menggunakan Model sungguhan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    /**
     * Menampilkan daftar dompet dari database.
     */
    public function index()
    {
        $user_id = Auth::id();

        $wallets = Wallet::where('user_id', $user_id)->get();
        $totalBalance = $wallets->sum('balance');

        return view('wallets.index', [
            'wallets' => $wallets,
            'totalBalance' => $totalBalance,
        ]);
    }

    /**
     * Menyimpan dompet baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'balance' => 'required|numeric|min:0',
        ]);

        Wallet::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'type' => $request->type,
            'balance' => $request->balance,
        ]);

        return redirect()->route('wallets.index');
    }
}
