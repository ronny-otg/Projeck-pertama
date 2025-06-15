<div class="relative bg-white">
    {{-- Tombol + tidak perlu tooltip --}}
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20">
        <a href="{{ route('transactions.create') }}" class="bg-blue-700 hover:bg-blue-800 text-white rounded-full h-16 w-16 flex items-center justify-center shadow-lg shadow-blue-500/30 transition transform active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
        </a>
    </div>
    
    <div class="border-t border-slate-200 h-16 flex justify-around items-center text-slate-400 relative z-10">
        {{-- =============================================== --}}
        {{-- PENAMBAHAN ATRIBUT TOOLTIP DIMULAI DI SINI --}}
        {{-- =============================================== --}}

        {{-- Ikon Home --}}
        <a href="{{ route('dashboard') }}" 
           class="nav-link-tooltip p-2 {{ request()->routeIs('dashboard') ? 'text-blue-700' : 'hover:text-blue-700' }}"
           data-tooltip="Home">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg>
        </a>
        
        {{-- Ikon Reports --}}
        <a href="{{ route('reports.index') }}" 
           class="nav-link-tooltip p-2 {{ request()->routeIs('reports.index') ? 'text-blue-700' : 'hover:text-blue-700' }}"
           data-tooltip="Laporan">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
        </a>

        <div class="w-16"></div> {{-- Placeholder --}}

        {{-- Ikon Budget --}}
        <a href="{{ route('budgets.index') }}" 
           class="nav-link-tooltip p-2 {{ request()->routeIs('budgets.index') ? 'text-blue-700' : 'hover:text-blue-700' }}"
           data-tooltip="Anggaran">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v-1m0-1V4m0 2.01M12 14c-1.11 0-2.08-.402-2.599-1M12 14v1m0 1v1m0-2.01M12 18v-1m0-1v-1m0 2.01M8.599 15.01C8.08 14.598 7.5 13.386 7.5 12c0-1.386.58-2.598 1.099-3.01M15.401 9.01C15.92 9.402 16.5 10.614 16.5 12c0 1.386-.58 2.598-1.099 3.01" /></svg>
        </a>
        
        {{-- Ikon Wallets --}}
        <a href="{{ route('wallets.index') }}" 
           class="nav-link-tooltip p-2 {{ request()->routeIs('wallets.index') ? 'text-blue-700' : 'hover:text-blue-700' }}"
           data-tooltip="Dompet">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
        </a>
    </div>
</div>
