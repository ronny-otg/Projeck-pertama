@extends('layouts.mobile-layout')

@section('content')
<div class="bg-slate-50 min-h-full">
    {{-- Kita gunakan Alpine.js untuk bottom sheet --}}
    <div x-data="{ showAddSheet: false }">
        <!-- Konten Halaman Dompet -->
        <div class="p-5">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Dompet Saya</h1>
                    <p class="text-base text-slate-500">Kelola semua sumber dana Anda.</p>
                </div>
                <div>
                    <button @click="showAddSheet = true" class="p-2 rounded-full bg-blue-100 text-blue-700 hover:bg-blue-200">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                    </button>
                </div>
            </div>
            <div class="mt-6 bg-white p-5 rounded-xl border border-slate-200/80">
                <p class="text-sm font-medium text-slate-500">Total Saldo di Semua Dompet</p>
                <p class="text-3xl font-bold text-slate-800 mt-1">Rp{{ number_format($totalBalance, 0, ',', '.') }}</p>
            </div>
        </div>
        
        <div class="px-5 pt-4 pb-24">
            <h2 class="text-lg font-bold text-slate-800 mb-3">Rincian Dompet</h2>
            <div class="space-y-3">
                @forelse($wallets as $wallet)
                    <div class="bg-white p-4 rounded-xl border border-slate-200/80 flex items-center space-x-4">
                        <div class="p-3 rounded-full 
                            @if($wallet->type == 'Uang Tunai') bg-green-100 text-green-600 
                            @elseif($wallet->type == 'Rekening Bank') bg-blue-100 text-blue-600
                            @elseif($wallet->type == 'E-Wallet') bg-sky-100 text-sky-600
                            @else bg-slate-100 text-slate-600 @endif">
                            
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                @if($wallet->type == 'Uang Tunai')
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.75A.75.75 0 013 4.5h.75m0 0h.75A.75.75 0 015.25 6v.75m0 0v.75a.75.75 0 01-.75.75h-.75M15 4.5v.75A.75.75 0 0114.25 6h-.75m0 0v-.75a.75.75 0 01.75-.75h.75m0 0h.75a.75.75 0 01.75.75v.75m0 0v.75a.75.75 0 01-.75.75h-.75m-6-12v.75a.75.75 0 01-.75.75H8.25m0 0v.75a.75.75 0 01-.75.75H6.75m0 0v.75A.75.75 0 016 12h.75m0 0v.75a.75.75 0 01.75.75h.75m0 0h.75a.75.75 0 01.75-.75v-.75m0 0V6.75A.75.75 0 0112 6h.75m0 0h.75a.75.75 0 01.75.75v.75m-3 6v.75a.75.75 0 01-.75.75H8.25m0 0v.75a.75.75 0 01-.75.75H6.75m0 0v.75A.75.75 0 016 18h.75m0 0v.75a.75.75 0 01.75.75h.75m0 0h.75a.75.75 0 01.75-.75v-.75m0 0V9.75A.75.75 0 0112 9h.75m0 0h.75a.75.75 0 01.75.75v.75M12 21v-1.5a.75.75 0 01.75-.75h.75m0 0h.75a.75.75 0 01.75.75v1.5m0 0v.75a.75.75 0 01-.75.75h-.75m-9-3.75h.75a.75.75 0 01.75.75v.75m0 0v.75a.75.75 0 01-.75.75h-.75m-1.5-1.5H5.25v.75a.75.75 0 01-.75.75H3.75v-.75a.75.75 0 01.75-.75z" />
                                @elseif($wallet->type == 'Rekening Bank')
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 21z" />
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                @endif
                            </svg>
                        </div>
                        <div class="flex-grow">
                            <p class="font-bold text-slate-700">{{ $wallet->name }}</p>
                            <p class="text-sm text-slate-500">{{ $wallet->type }}</p>
                        </div>
                        <p class="text-lg font-semibold text-slate-800">Rp{{ number_format($wallet->balance, 0, ',', '.') }}</p>
                    </div>
                @empty
                    <p class="text-center text-slate-500 py-4">Tekan tombol '+' untuk menambah dompet pertama Anda.</p>
                @endforelse
            </div>
        </div>

        <!-- Bottom Sheet untuk Form Tambah Dompet -->
        <div x-show="showAddSheet" x-cloak x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50 z-30"></div>
        <div x-show="showAddSheet" x-cloak x-transition:enter="ease-out duration-300" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="ease-in duration-200" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full" @click.away="showAddSheet = false" class="fixed bottom-0 left-0 right-0 w-full bg-white rounded-t-2xl p-5 z-40">
            <h2 class="text-xl font-bold text-slate-800 mb-4">Tambah Dompet Baru</h2>
            <form action="{{ route('wallets.store') }}" method="POST" class="space-y-6">
                @csrf
                <div><label for="name" class="text-sm font-semibold text-slate-600">Nama Dompet</label><input type="text" name="name" id="name" required placeholder="Contoh: Dompet Utama, Bank BRI" class="mt-1 w-full text-lg px-4 py-3 border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></div>
                <div><label for="type" class="text-sm font-semibold text-slate-600">Tipe Dompet</label><select name="type" id="type" required class="mt-1 w-full text-lg px-4 py-3 border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"><option>Uang Tunai</option><option>Rekening Bank</option><option>E-Wallet</option><option>Lainnya</option></select></div>
                <div><label for="balance" class="text-sm font-semibold text-slate-600">Saldo Awal</label><div class="mt-1 relative rounded-md"><div class="pointer-events-none absolute inset-y-0 left-0 pl-4 flex items-center"><span class="text-slate-500 sm:text-lg">Rp</span></div><input type="number" name="balance" id="balance" required class="w-full text-lg pl-12 pr-4 py-3 border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="0"></div></div>
                <div class="pt-4"><button type="submit" class="w-full bg-blue-700 text-white font-bold py-4 px-4 rounded-lg hover:bg-blue-800 active:scale-95 transition-transform">Simpan Dompet</button></div>
            </form>
        </div>
    </div>
</div>
@endsection
