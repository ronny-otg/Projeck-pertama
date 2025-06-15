<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

// Grup route yang hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {
    
    // Route untuk dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route untuk halaman profil (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route untuk form tambah transaksi
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    
    // Route untuk laporan
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // ===============================================
    // ROUTE UNTUK ANGGARAN (LENGKAP)
    // ===============================================
    Route::get('/budgets', [BudgetController::class, 'index'])->name('budgets.index');
    // TAMBAHAN DI SINI: Route untuk menyimpan data anggaran
    Route::post('/budgets', [BudgetController::class, 'store'])->name('budgets.store');

    // Route untuk dompet
    Route::get('/wallets', [WalletController::class, 'index'])->name('wallets.index');
    Route::get('/wallets/create', [WalletController::class, 'create'])->name('wallets.create');
    Route::post('/wallets', [WalletController::class, 'store'])->name('wallets.store');
    
    // Route untuk notifikasi
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

});

// Ini memuat semua route lain untuk login, register, dll. JANGAN DIHAPUS.
require __DIR__.'/auth.php';
