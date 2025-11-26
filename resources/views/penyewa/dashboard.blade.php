@extends('layouts.app')

@section('title', 'Dashboard Penyewa - KostKu')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Welcome Header with Animation -->
        <div class="mb-8 animate-fade-in">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">
                        Selamat Datang, <span class="text-blue-600">{{ auth()->user()->name ?? 'Penyewa' }}</span>! 👋
                    </h1>
                    <p class="text-gray-600 text-lg">Temukan kost impian Anda dengan mudah dan cepat</p>
                </div>
                <a href="{{ route('penyewa.cari-kost') }}" 
                   class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-search mr-2"></i>Cari Kost Sekarang
                </a>
            </div>
        </div>

        <!-- Stats Cards with Gradient -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium mb-1">Total Kost</p>
                        <p class="text-4xl font-bold">{{ $totalKost ?? 0 }}</p>
                        <p class="text-blue-100 text-xs mt-1">Kost tersedia</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-home text-3xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium mb-1">Kamar Tersedia</p>
                        <p class="text-4xl font-bold">{{ $kamarTersedia ?? 0 }}</p>
                        <p class="text-green-100 text-xs mt-1">Siap dihuni</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-door-open text-3xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium mb-1">Booking Aktif</p>
                        <p class="text-4xl font-bold">{{ $bookingAktif ?? 0 }}</p>
                        <p class="text-purple-100 text-xs mt-1">Booking Anda</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-calendar-check text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <a href="{{ route('penyewa.kost.tipe', 'cewe') }}"
               class="bg-white hover:bg-pink-50 border-2 border-pink-200 rounded-xl p-4 text-center transition-all duration-300 hover:shadow-lg group">
                <div class="bg-pink-100 text-pink-600 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-female text-xl"></i>
                </div>
                <p class="font-semibold text-gray-800">Kost Cewe</p>
            </a>

            <a href="{{ route('penyewa.kost.tipe', 'cowo') }}"
               class="bg-white hover:bg-blue-50 border-2 border-blue-200 rounded-xl p-4 text-center transition-all duration-300 hover:shadow-lg group">
                <div class="bg-blue-100 text-blue-600 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-male text-xl"></i>
                </div>
                <p class="font-semibold text-gray-800">Kost Cowo</p>
            </a>

            <a href="{{ route('penyewa.kost.tipe', 'campur') }}"
               class="bg-white hover:bg-purple-50 border-2 border-purple-200 rounded-xl p-4 text-center transition-all duration-300 hover:shadow-lg group">
                <div class="bg-purple-100 text-purple-600 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <p class="font-semibold text-gray-800">Kost Campur</p>
            </a>

            <a href="{{ route('penyewa.booking') }}" 
               class="bg-white hover:bg-orange-50 border-2 border-orange-200 rounded-xl p-4 text-center transition-all duration-300 hover:shadow-lg group">
                <div class="bg-orange-100 text-orange-600 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-clipboard-list text-xl"></i>
                </div>
                <p class="font-semibold text-gray-800">Booking Saya</p>
            </a>
        </div>

        <!-- Kost Populer -->
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 flex items-center">
                    <span class="bg-gradient-to-r from-orange-400 to-red-500 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3">
                        <i class="fas fa-fire"></i>
                    </span>
                    Kost Populer
                </h2>
                <a href="{{ route('penyewa.cari-kost') }}" 
                   class="text-blue-600 hover:text-blue-800 font-semibold text-sm flex items-center group">
                    Lihat Semua 
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($kostPopuler ?? [] as $kost)
                <div class="group border-2 border-gray-100 rounded-2xl overflow-hidden hover:shadow-2xl hover:border-transparent transition-all duration-300 transform hover:-translate-y-2">
                    <div class="relative overflow-hidden">
                        <div class="bg-gradient-to-br 
                            {{ $kost->jenis == 'cewe' ? 'from-pink-400 via-pink-500 to-pink-600' : ($kost->jenis == 'cowo' ? 'from-blue-400 via-blue-500 to-blue-600' : 'from-purple-400 via-purple-500 to-purple-600') }} 
                            h-48 flex items-center justify-center relative group-hover:scale-110 transition-transform duration-500">
                            <i class="{{ $kost->jenis == 'cewe' ? 'fas fa-female' : ($kost->jenis == 'cowo' ? 'fas fa-male' : 'fas fa-users') }} 
                               text-white text-6xl transform group-hover:scale-110 transition-transform duration-300"></i>
                            
                            <!-- Decorative circles -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
                            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"></div>
                        </div>
                        
                        <span class="absolute top-3 right-3 
                            {{ $kost->jenis == 'cewe' ? 'bg-pink-600' : ($kost->jenis == 'cowo' ? 'bg-blue-600' : 'bg-purple-600') }} 
                            text-white px-4 py-1.5 rounded-full text-xs font-bold shadow-lg">
                            {{ ucfirst($kost->jenis) ?? 'Lainnya' }}
                        </span>
                        
                        <div class="absolute top-3 left-3 bg-white px-3 py-1.5 rounded-full text-xs font-semibold shadow-lg">
                            <i class="fas fa-door-open text-green-600 mr-1"></i>
                            <span class="text-gray-800">{{ $kost->kamar_tersedia ?? 0 }} Kamar</span>
                        </div>
                    </div>
                    
                    <div class="p-5">
                        <h3 class="font-bold text-xl text-gray-800 mb-2 group-hover:text-blue-600 transition-colors">
                            {{ $kost->nama ?? '-' }}
                        </h3>
                        
                        <div class="flex items-start text-gray-600 text-sm mb-3">
                            <i class="fas fa-map-marker-alt text-red-500 mr-2 mt-1"></i>
                            <span class="line-clamp-2">{{ $kost->alamat ?? '-' }}</span>
                        </div>
                        
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-3 mb-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-gray-600 mb-1">Harga per bulan</p>
                                    <p class="text-2xl font-bold text-blue-600">
                                        Rp {{ number_format($kost->harga ?? 0, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="text-blue-600">
                                    <i class="fas fa-tag text-3xl"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap gap-2 mb-4">
                            @if($kost->kasur ?? false)
                            <span class="bg-gray-100 text-gray-700 px-3 py-1.5 rounded-lg text-xs font-medium">
                                <i class="fas fa-bed mr-1"></i>Kasur
                            </span>
                            @endif
                            @if($kost->km_dalam ?? false)
                            <span class="bg-gray-100 text-gray-700 px-3 py-1.5 rounded-lg text-xs font-medium">
                                <i class="fas fa-bath mr-1"></i>KM Dalam
                            </span>
                            @endif
                            @if($kost->dapur ?? false)
                            <span class="bg-gray-100 text-gray-700 px-3 py-1.5 rounded-lg text-xs font-medium">
                                <i class="fas fa-utensils mr-1"></i>Dapur
                            </span>
                            @endif
                        </div>
                        
                        <a href="{{ route('penyewa.kost.show', $kost->id ?? 0) }}" 
                           class="block w-full bg-gradient-to-r 
                                {{ $kost->jenis == 'cewe' ? 'from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700' : ($kost->jenis == 'cowo' ? 'from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700' : 'from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700') }}
                                text-white text-center py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                            <i class="fas fa-eye mr-2"></i>Lihat Detail
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <i class="fas fa-home text-gray-300 text-6xl mb-4"></i>
                    <p class="text-gray-500 text-lg font-medium">Belum ada kost populer</p>
                    <a href="{{ route('penyewa.cari-kost') }}" class="inline-block mt-4 text-blue-600 hover:text-blue-800 font-semibold">
                        Mulai Cari Kost <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Booking Terbaru -->
        @if(isset($bookingTerbaru) && $bookingTerbaru->count() > 0)
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 flex items-center">
                <span class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3">
                    <i class="fas fa-history"></i>
                </span>
                Booking Terbaru
            </h2>
            
            <div class="space-y-4">
                @foreach($bookingTerbaru as $booking)
                <div class="border-l-4 
                    {{ $booking->status == 'pending' ? 'border-yellow-500 bg-yellow-50' : '' }}
                    {{ $booking->status == 'aktif' ? 'border-green-500 bg-green-50' : '' }}
                    {{ $booking->status == 'selesai' ? 'border-gray-500 bg-gray-50' : '' }}
                    p-5 rounded-r-xl hover:shadow-lg transition-all duration-300">
                    <div class="flex justify-between items-start flex-wrap gap-4">
                        <div class="flex-1">
                            <h3 class="font-bold text-lg text-gray-800">{{ $booking->kamar->kost->nama ?? 'Kost tidak ditemukan' }}</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-door-open mr-1"></i>
                                Kamar {{ $booking->kamar->nomor_kamar ?? '-' }}
                            </p>
                            <p class="text-xs text-gray-500 mt-2">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ optional($booking->created_at)->format('d M Y H:i') }}
                            </p>
                        </div>
                        <span class="px-4 py-2 rounded-full text-sm font-bold
                            {{ $booking->status == 'pending' ? 'bg-yellow-500 text-white' : '' }}
                            {{ $booking->status == 'aktif' ? 'bg-green-500 text-white' : '' }}
                            {{ $booking->status == 'selesai' ? 'bg-gray-500 text-white' : '' }}
                            shadow-md">
                            {{ ucfirst($booking->status ?? '-') }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-6 text-center">
                <a href="{{ route('penyewa.booking') }}" 
                   class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105">
                    Lihat Semua Booking <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
        @endif

    </div>
</div>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection