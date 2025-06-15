@extends('layouts.mobile-layout')

@section('content')
{{-- 1. Inisialisasi Alpine.js untuk mengontrol bottom sheet --}}
<div x-data="{ showBudgetSheet: false }" class="bg-slate-50 min-h-full">
    
    <!-- Header Halaman dengan Tombol Aksi -->
    <div class="p-5 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Anggaran Bulanan</h1>
            <p class="text-base text-slate-500">Pantau batas pengeluaran Anda.</p>
        </div>
        <div>
            {{-- 2. Tombol "Set Anggaran" yang memicu Alpine --}}
            <button @click="showBudgetSheet = true" class="p-2 rounded-full bg-blue-100 text-blue-700 hover:bg-blue-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
            </button>
        </div>
    </div>

    <!-- Kartu Anggaran Utama -->
    <div class="px-5">
        <div class="bg-white p-5 rounded-xl border border-slate-200/80 space-y-3">
            <div class="flex justify-between items-center text-sm">
                <p class="text-slate-500">Terpakai dari <span class="font-bold text-slate-600">Rp{{ number_format($budgetAmount, 0, ',', '.') }}</span></p>
                <p class="font-bold {{ $percentageUsed > 80 ? 'text-red-500' : 'text-slate-600' }}">{{ number_format($percentageUsed, 1) }}%</p>
            </div>
            <div class="w-full bg-slate-200 rounded-full h-2.5">
                <div class="bg-blue-700 h-2.5 rounded-full" style="width: {{ $percentageUsed }}%"></div>
            </div>
            <div class="flex justify-between items-center text-sm">
                <p class="text-slate-500">Terpakai: <span class="font-semibold text-slate-700">Rp{{ number_format($totalSpending, 0, ',', '.') }}</span></p>
                <p class="text-slate-500">Sisa: <span class="font-semibold text-green-600">Rp{{ number_format($remainingAmount, 0, ',', '.') }}</span></p>
            </div>
        </div>
    </div>

    <!-- Rincian Pengeluaran per Kategori -->
    <div class="p-5 mt-4 pb-24">
        <h2 class="text-lg font-bold text-slate-800 mb-3">Rincian Pengeluaran</h2>
        <div class="space-y-4">
            @forelse($spendingByCategory as $category)
                <div class="bg-white p-4 rounded-xl border border-slate-200/80">
                    <div class="flex justify-between items-center mb-1">
                        {{-- Perbaikan variabel dari ->amount menjadi ->total --}}
                        <p class="font-bold text-slate-700">{{ $category->category }}</p>
                        <p class="text-sm text-slate-500">Rp{{ number_format($category->total, 0, ',', '.') }}</p>
                    </div>
                    {{-- Perbaikan variabel dari ->percentage menjadi perhitungan manual --}}
                    @php $categoryPercentage = $budgetAmount > 0 ? ($category->total / $budgetAmount) * 100 : 0; @endphp
                    <div class="w-full bg-slate-200 rounded-full h-1.5">
                        <div class="bg-blue-500 h-1.5 rounded-full" style="width: {{ $categoryPercentage }}%"></div>
                    </div>
                </div>
            @empty
                <p class="text-center text-slate-500 py-4">Belum ada data pengeluaran.</p>
            @endforelse
        </div>
    </div>

    {{-- =============================================== --}}
    {{--    3. BOTTOM SHEET UNTUK FORM SET ANGGARAN       --}}
    {{-- =============================================== --}}
    <!-- Latar Belakang Gelap -->
    <div x-show="showBudgetSheet" x-cloak x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50 z-30"></div>
    
    <!-- Panel Konten Form -->
    <div x-show="showBudgetSheet" x-cloak x-transition:enter="ease-out duration-300" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="ease-in duration-200" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full" @click.away="showBudgetSheet = false" class="fixed bottom-0 left-0 right-0 w-full bg-white rounded-t-2xl p-5 z-40">
        <h2 class="text-xl font-bold text-slate-800 mb-4">Atur Anggaran Bulan Ini</h2>
        <form action="{{ route('budgets.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="amount" class="text-sm font-semibold text-slate-600">Jumlah Anggaran</label>
                <div class="mt-1 relative rounded-md">
                    <div class="pointer-events-none absolute inset-y-0 left-0 pl-4 flex items-center"><span class="text-slate-500 sm:text-lg">Rp</span></div>
                    <input type="number" name="amount" id="amount" required value="{{ $budgetAmount > 0 ? $budgetAmount : '' }}" class="w-full text-lg pl-12 pr-4 py-3 border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="0">
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" class="w-full bg-blue-700 text-white font-bold py-4 px-4 rounded-lg hover:bg-blue-800 active:scale-95 transition-transform">Simpan Anggaran</button>
            </div>
        </form>
    </div>
</div>
@endsection
