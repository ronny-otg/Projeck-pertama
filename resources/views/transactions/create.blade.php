@extends('layouts.mobile-layout')

@section('content')
<div class="bg-slate-50">
    <!-- Header Halaman -->
    <div class="p-5 flex items-center">
        <a href="{{ route('dashboard') }}" class="text-slate-600 p-1 rounded-full hover:bg-slate-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
        </a>
        <h1 class="text-xl font-bold text-slate-800 tracking-tight ml-4">Tambah Transaksi</h1>
    </div>

    <!-- Formulir -->
    <form action="{{ route('transactions.store') }}" method="POST" class="p-5 space-y-6">
        @csrf
        
        <!-- Input Jumlah Uang -->
        <div>
            <label for="amount" class="text-sm font-semibold text-slate-600">Jumlah</label>
            <div class="mt-1 relative rounded-md">
                <div class="pointer-events-none absolute inset-y-0 left-0 pl-4 flex items-center">
                    <span class="text-slate-500 sm:text-lg">Rp</span>
                </div>
                <input type="number" name="amount" id="amount" required class="w-full text-lg pl-12 pr-4 py-3 border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="0">
            </div>
        </div>

        <!-- Pilihan Tipe Transaksi -->
        <div>
            <label class="text-sm font-semibold text-slate-600">Tipe</label>
            <div class="mt-2 grid grid-cols-2 gap-4">
                <label for="type_pengeluaran" class="flex items-center p-3 border-2 border-slate-300 rounded-lg has-[:checked]:border-red-500 has-[:checked]:bg-red-50">
                    <input type="radio" id="type_pengeluaran" name="type" value="pengeluaran" checked class="h-4 w-4 text-red-600 border-gray-300 focus:ring-red-500">
                    <span class="ml-3 font-medium text-slate-700">Pengeluaran</span>
                </label>
                <label for="type_pemasukan" class="flex items-center p-3 border-2 border-slate-300 rounded-lg has-[:checked]:border-green-500 has-[:checked]:bg-green-50">
                    <input type="radio" id="type_pemasukan" name="type" value="pemasukan" class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
                    <span class="ml-3 font-medium text-slate-700">Pemasukan</span>
                </label>
            </div>
        </div>

        <!-- Input Kategori -->
        <div>
            <label for="category" class="text-sm font-semibold text-slate-600">Kategori</label>
            <input type="text" name="category" id="category" required placeholder="Contoh: Makanan, Gaji, dll." class="mt-1 w-full text-lg px-4 py-3 border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Input Tanggal -->
        <div>
            <label for="transaction_date" class="text-sm font-semibold text-slate-600">Tanggal</label>
            <input type="date" name="transaction_date" id="transaction_date" value="{{ date('Y-m-d') }}" required class="mt-1 w-full text-lg px-4 py-3 border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <!-- Tombol Simpan -->
        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-700 text-white font-bold py-4 px-4 rounded-lg hover:bg-blue-800 active:scale-95 transition-transform">
                Simpan Transaksi
            </button>
        </div>
    </form>
</div>
@endsection
