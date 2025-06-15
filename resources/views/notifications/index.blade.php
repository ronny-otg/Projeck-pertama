@extends('layouts.mobile-layout')

@section('content')
<div class="bg-slate-50">
    <!-- Header Halaman -->
    <div class="p-5 flex items-center">
        <a href="{{ route('dashboard') }}" class="text-slate-600 p-1 rounded-full hover:bg-slate-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
        </a>
        <h1 class="text-xl font-bold text-slate-800 tracking-tight ml-4">Notifikasi</h1>
    </div>

    <!-- Daftar Notifikasi -->
    <div class="px-5 pb-24">
        <div class="space-y-3">
            @forelse($notifications as $notification)
                <div class="bg-white p-4 rounded-xl border border-slate-200/80 flex items-start space-x-4">
                    <div class="p-3 rounded-full {{ $notification->icon_color }}">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                           {!! $notification->icon_svg !!}
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <p class="font-bold text-slate-800">{{ $notification->title }}</p>
                        <p class="text-sm text-slate-500 mt-0.5">{{ $notification->description }}</p>
                        <p class="text-xs text-slate-400 mt-2">{{ $notification->timestamp }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-16">
                    <p class="text-slate-500">Tidak ada notifikasi baru.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
