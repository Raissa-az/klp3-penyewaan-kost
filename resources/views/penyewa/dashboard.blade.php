@extends('layouts.app')

@section('title', 'Dashboard Penyewa - KostKu')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Selamat Datang, {{ auth()->user()->name }}!</h1>
            <p class="text-gray-600 mt-2">Temukan kost impian Anda dengan mudah dan cepat</p>
        </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Kost -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Kost</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $totalKost ?? 3 }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-building text-3xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Kamar Tersedia -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Kamar Tersedia</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $kamarTersedia ?? 12 }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-door-open text-3xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Booking Aktif -->
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Booking Aktif</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $bookingAktif ?? 0 }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-calendar-check text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Kost Populer -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-fire text-orange-500 mr-2"></i>Kost Populer
                </h2>
                <a href="{{ route('penyewa.cari-kost') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Kost Khusus Cewe -->
                <div class="border rounded-lg overflow-hidden hover:shadow-xl transition group">
                    <div class="relative">
                        <div class="bg-gradient-to-r from-pink-400 to-pink-500 h-48 flex items-center justify-center">
                            <i class="fas fa-female text-white text-6xl"></i>
                        </div>
                        <span class="absolute top-3 right-3 bg-pink-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Khusus Cewe
                        </span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-800 mb-2">Kost Putri Melati</h3>
                        <div class="flex items-center text-gray-600 text-sm mb-2">
                            <i class="fas fa-map-marker-alt text-pink-500 mr-2"></i>
                            <span>Jl. Sudirman No. 123, Jakarta</span>
                        </div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-blue-600 font-bold text-xl">Rp 1.500.000</span>
                            <span class="text-sm text-gray-500">/bulan</span>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                                <i class="fas fa-bed mr-1"></i>Kasur
                            </span>
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                                <i class="fas fa-bath mr-1"></i>KM Dalam
                            </span>
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                                <i class="fas fa-wind mr-1"></i>Kipas
                            </span>
                        </div>
                        <a href="{{ route('penyewa.detail', 1) }}" class="block w-full bg-pink-500 hover:bg-pink-600 text-white text-center py-2 rounded-lg font-semibold transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                
                <!-- Kost Khusus Cowo -->
                <div class="border rounded-lg overflow-hidden hover:shadow-xl transition group">
                    <div class="relative">
                        <div class="bg-gradient-to-r from-blue-400 to-blue-500 h-48 flex items-center justify-center">
                            <i class="fas fa-male text-white text-6xl"></i>
                        </div>
                        <span class="absolute top-3 right-3 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Khusus Cowo
                        </span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-800 mb-2">Kost Putra Wijaya</h3>
                        <div class="flex items-center text-gray-600 text-sm mb-2">
                            <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                            <span>Jl. Gatot Subroto No. 45, Jakarta</span>
                        </div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-blue-600 font-bold text-xl">Rp 1.200.000</span>
                            <span class="text-sm text-gray-500">/bulan</span>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                                <i class="fas fa-bed mr-1"></i>Kasur
                            </span>
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                                <i class="fas fa-bath mr-1"></i>KM Sharing
                            </span>
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                                <i class="fas fa-utensils mr-1"></i>Dapur
                            </span>
                        </div>
                        <a href="{{ route('penyewa.detail', 2) }}" class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-2 rounded-lg font-semibold transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                
                <!-- Kost Campuran -->
                <div class="border rounded-lg overflow-hidden hover:shadow-xl transition group">
                    <div class="relative">
                        <div class="bg-gradient-to-r from-purple-400 to-purple-500 h-48 flex items-center justify-center">
                            <i class="fas fa-users text-white text-6xl"></i>
                        </div>
                        <span class="absolute top-3 right-3 bg-purple-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Campuran
                        </span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-800 mb-2">Kost Harmoni</h3>
                        <div class="flex items-center text-gray-600 text-sm mb-2">
                            <i class="fas fa-map-marker-alt text-purple-500 mr-2"></i>
                            <span>Jl. Thamrin No. 78, Jakarta</span>
                        </div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-blue-600 font-bold text-xl">Rp 1.000.000</span>
                            <span class="text-sm text-gray-500">/bulan</span>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                                <i class="fas fa-bath mr-1"></i>KM Dalam
                            </span>
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                                <i class="fas fa-ban mr-1"></i>Kosong
                            </span>
                        </div>
                        <a href="{{ route('penyewa.detail', 3) }}" class="block w-full bg-purple-500 hover:bg-purple-600 text-white text-center py-2 rounded-lg font-semibold transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Booking Terbaru -->
        @if(isset($bookingTerbaru) && count($bookingTerbaru) > 0)
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                <i class="fas fa-history text-blue-600 mr-2"></i>Booking Terbaru
            </h2>
            
            <div class="space-y-4">
                @foreach($bookingTerbaru as $booking)
                <div class="border-l-4 border-blue-500 bg-gray-50 p-4 rounded">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $booking->kamar->kost->nama }}</h3>
                            <p class="text-sm text-gray-600">Kamar {{ $booking->kamar->nomor_kamar }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $booking->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $booking->status == 'terbooking' ? 'bg-green-100 text-green-800' : '' }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection