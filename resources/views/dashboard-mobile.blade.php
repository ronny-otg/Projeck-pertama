{{-- Memberitahu file ini untuk memakai "Bingkai" dari layouts/mobile-layout.blade.php --}}
@extends('layouts.mobile-layout')

{{-- Semua kode di bawah ini akan dimasukkan ke dalam @yield('content') di file Bingkai --}}
@section('content')
    <div class="bg-slate-50">

        <!-- Bagian Atas (Header & Saldo) -->
        <div class="p-5 space-y-6">
            
            <!-- Header -->
            <div class="flex justify-between items-center">
                <div>
                    @php
                        date_default_timezone_set('Asia/Jakarta');
                        $hour = date('G');
                        $sapaan = 'Selamat Datang,';
                        if ($hour >= 5 && $hour < 12) { $sapaan = 'Selamat Pagi,'; } 
                        elseif ($hour >= 12 && $hour < 15) { $sapaan = 'Selamat Siang,'; } 
                        elseif ($hour >= 15 && $hour < 19) { $sapaan = 'Selamat Sore,'; } 
                        else { $sapaan = 'Selamat Malam,'; }
                    @endphp
                    <p class="text-base font-medium text-slate-500">{{ $sapaan }}</p>
                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Roni</h1>
                </div>
                
                <!-- Bagian Kanan: Aksi & Profil dengan Dropdown -->
                <div class="flex items-center space-x-2">

                    {{-- =============================================== --}}
                    {{-- PERBAIKAN TOMBOL NOTIFIKASI DI SINI --}}
                    {{-- =============================================== --}}
                    <a href="{{ route('notifications.index') }}" class="p-2 rounded-full text-slate-500 hover:bg-slate-200/80 relative">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                        <span class="absolute top-2 right-2 block h-1.5 w-1.5 rounded-full bg-red-500 ring-2 ring-slate-50"></span>
                    </a>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="h-10 w-10 rounded-full object-cover ring-2 ring-slate-200 focus:ring-blue-500 focus:outline-none">
                             <img class="h-full w-full rounded-full" src="https://placehold.co/100x100/1e293b/ffffff?text=R" alt="User Avatar" />
                        </button>
                    
                        <div x-show="open" 
                             @click.away="open = false" 
                             x-transition
                             class="absolute right-0 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                             style="display: none;">
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();"
                                   class="flex w-full items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                     <svg class="mr-2 h-5 w-5 text-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                     </svg>
                                     <span>Logout</span>
                                 </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Kartu Saldo -->
            <div class="bg-gradient-to-br from-slate-800 to-slate-900 text-white p-5 rounded-2xl shadow-lg">
                <p class="text-sm text-slate-400">Total Saldo</p>
                <p class="text-3xl font-bold tracking-tight mt-1">Rp{{ number_format($saldo ?? 0, 0, ',', '.') }}</p>
                <div class="mt-4 grid grid-cols-2 gap-4 text-sm"><div class="flex items-center space-x-2"><div class="p-1.5 bg-green-500/20 rounded-full"><svg class="h-4 w-4 text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg></div><div><p class="text-slate-400">Pemasukan</p><p class="font-semibold">Rp{{ number_format($pemasukan ?? 0, 0, ',', '.') }}</p></div></div><div class="flex items-center space-x-2"><div class="p-1.5 bg-red-500/20 rounded-full"><svg class="h-4 w-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" /></svg></div><div><p class="text-slate-400">Pengeluaran</p><p class="font-semibold">Rp{{ number_format($pengeluaran ?? 0, 0, ',', '.') }}</p></div></div></div>
            </div>
        </div>

        <!-- Bagian List Transaksi -->
        <div class="px-5 pb-24">
            <h2 class="text-lg font-bold text-slate-800 mb-3">Transaksi Terakhir</h2>
            @include('components.mobile-transaction-list', ['groupedTransactions' => $groupedTransactions])
        </div>
    </div>
@endsection
