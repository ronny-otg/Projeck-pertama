{{-- HAPUS FILE INI: resources/views/components/mobile-summary-card.blade.php --}}
{{-- Fungsinya sudah dipindahkan langsung ke dashboard-mobile.blade.php --}}


{{-- File: resources/views/components/mobile-transaction-list.blade.php (Re-Design) --}}
<div class="space-y-4">
    @forelse($groupedTransactions as $date => $transactions)
        <div class="space-y-3">
            <p class="font-semibold text-sm text-slate-500">{{ \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMMM') }}</p>
            <div class="bg-white rounded-xl border border-slate-200/80 divide-y divide-slate-200/80">
                @foreach($transactions as $transaction)
                <div class="p-3 flex items-center space-x-4">
                    <div class="p-3 rounded-full {{ $transaction->type == 'pemasukan' ? 'bg-green-100' : 'bg-red-100' }}">
                        {{-- Contoh Ikon (bisa diganti sesuai kategori) --}}
                        <svg class="h-6 w-6 {{ $transaction->type == 'pemasukan' ? 'text-green-600' : 'text-red-600' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <div class="flex-grow">
                        <p class="font-semibold text-slate-800">{{ $transaction->category }}</p>
                        <p class="text-sm text-slate-400">{{ $transaction->description ?? 'Tanpa deskripsi' }}</p>
                    </div>
                    <p class="font-bold text-lg {{ $transaction->type == 'pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $transaction->type == 'pemasukan' ? '+' : '-' }}Rp{{ number_format($transaction->amount, 0, ',', '.') }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="text-center py-16">
            <p class="text-slate-500">Belum ada data transaksi.</p>
        </div>
    @endforelse
</div>

