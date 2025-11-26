@extends('layouts.app')

@section('title', 'Booking Saya - KostKu')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <a href="{{ route('penyewa.dashboard') }}" 
                   class="text-gray-600 hover:text-blue-600 transition-colors">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <h1 class="text-4xl font-bold text-gray-800">
                    <i class="fas fa-clipboard-list text-blue-600 mr-3"></i>
                    Booking Saya
                </h1>
            </div>
            <p class="text-gray-600 text-lg">Kelola semua booking kost Anda di sini</p>
        </div>

        <!-- Booking Cards -->
        <div class="space-y-6">
            @forelse($bookings as $booking)
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300">
                <div class="border-l-8 
                    {{ $booking->status == 'pending' ? 'border-yellow-500' : '' }}
                    {{ $booking->status == 'aktif' ? 'border-green-500' : '' }}
                    {{ $booking->status == 'selesai' ? 'border-gray-500' : '' }}
                    p-6">
                    
                    <div class="flex justify-between items-start flex-wrap gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="px-4 py-2 rounded-full text-sm font-bold
                                    {{ $booking->status == 'pending' ? 'bg-yellow-500 text-white' : '' }}
                                    {{ $booking->status == 'aktif' ? 'bg-green-500 text-white' : '' }}
                                    {{ $booking->status == 'selesai' ? 'bg-gray-500 text-white' : '' }}
                                    shadow-md">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-800 mb-2">
                                {{ $booking->kamar->kost->nama ?? 'Kost tidak ditemukan' }}
                            </h3>
                            
                            <div class="space-y-2 text-gray-600">
                                <p>
                                    <i class="fas fa-door-open text-blue-600 mr-2"></i>
                                    <span class="font-semibold">Kamar:</span> {{ $booking->kamar->nomor_kamar ?? '-' }}
                                </p>
                                <p>
                                    <i class="fas fa-calendar text-green-600 mr-2"></i>
                                    <span class="font-semibold">Tanggal Booking:</span> 
                                    {{ $booking->created_at->format('d M Y, H:i') }}
                                </p>
                                <p>
                                    <i class="fas fa-money-bill-wave text-yellow-600 mr-2"></i>
                                    <span class="font-semibold">Harga:</span> 
                                    Rp {{ number_format($booking->kamar->kost->harga ?? 0, 0, ',', '.') }}/bulan
                                </p>
                            </div>
                        </div>

                        <div class="text-right">
                            @if($booking->status == 'pending')
                            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                                <i class="fas fa-clock text-yellow-600 text-2xl mb-2"></i>
                                <p class="text-sm text-yellow-700 font-medium">Menunggu konfirmasi admin</p>
                            </div>
                            @elseif($booking->status == 'aktif')
                            <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                                <i class="fas fa-check-circle text-green-600 text-2xl mb-2"></i>
                                <p class="text-sm text-green-700 font-medium">Booking aktif</p>
                            </div>
                            @else
                            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                                <i class="fas fa-check-double text-gray-600 text-2xl mb-2"></i>
                                <p class="text-sm text-gray-700 font-medium">Booking selesai</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                <i class="fas fa-clipboard-list text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Booking</h3>
                <p class="text-gray-600 mb-6">Anda belum memiliki booking aktif. Mulai cari kost impian Anda!</p>
                <a href="{{ route('penyewa.dashboard') }}" 
                   class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-search mr-2"></i>Cari Kost Sekarang
                </a>
            </div>
            @endforelse
        </div>

    </div>
</div>
@endsection