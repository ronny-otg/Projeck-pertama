@extends('layouts.mobile-layout')

@section('content')
<div class="bg-slate-50">
    <!-- Header Halaman -->
    <div class="p-5">
        <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Laporan Keuangan</h1>
        <p class="text-base text-slate-500">Ringkasan bulan {{ \Carbon\Carbon::now()->isoFormat('MMMM YYYY') }}</p>
    </div>

    <!-- Kartu Ringkasan Laporan -->
    <div class="px-5 space-y-4">
        <div class="bg-white p-4 rounded-xl border border-slate-200/80">
            <p class="text-sm font-medium text-slate-500">Total Pemasukan</p>
            <p class="text-2xl font-bold text-green-600">Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200/80">
            <p class="text-sm font-medium text-slate-500">Total Pengeluaran</p>
            <p class="text-2xl font-bold text-red-600">Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Grafik Pengeluaran Harian -->
    <div class="p-5 mt-4">
        <h2 class="text-lg font-bold text-slate-800 mb-3">Pengeluaran 7 Hari Terakhir</h2>
        <div class="bg-white p-5 rounded-xl border border-slate-200/80">
            {{-- Wadah untuk grafik --}}
            <div class="flex justify-between items-end h-48 space-x-2">
                {{-- Loop untuk membuat setiap bar di grafik --}}
                @foreach($dataGrafik as $data)
                    <div class="flex-1 h-full flex flex-col items-center justify-end group" title="Rp{{ number_format($data['total'], 0, ',', '.') }}">
                        {{-- PERBAIKAN Tampilan Bar Grafik --}}
                        <div class="w-full bg-blue-200 rounded-t-md group-hover:bg-blue-400 transition-colors" 
                             style="height: {{ $data['height'] }}%;">
                             {{-- Bar akan memiliki tinggi sesuai persentase yang dihitung --}}
                        </div>
                        <p class="mt-2 text-xs font-semibold text-slate-500">{{ $data['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
