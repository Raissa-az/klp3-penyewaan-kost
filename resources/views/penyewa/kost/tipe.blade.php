@extends('layouts.app')

@section('title', 'Kost ' . ucfirst($tipe) . ' - KostKu')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header dengan ikon sesuai tipe -->
        <div class="mb-8">
            <a href="{{ route('penyewa.dashboard') }}" 
               class="inline-flex items-center text-gray-600 hover:text-gray-800 mb-4 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Dashboard
            </a>
            
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center mr-4 shadow-lg
                        {{ $tipe == 'cewe' ? 'bg-gradient-to-br from-pink-500 to-pink-600' : '' }}
                        {{ $tipe == 'cowo' ? 'bg-gradient-to-br from-blue-500 to-blue-600' : '' }}
                        {{ $tipe == 'campur' ? 'bg-gradient-to-br from-purple-500 to-purple-600' : '' }}">
                        <i class="fas {{ $tipe == 'cewe' ? 'fa-female' : ($tipe == 'cowo' ? 'fa-male' : 'fa-users') }} text-white text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold text-gray-800">
                            Kost {{ ucfirst($tipe) }}
                        </h1>
                        <p class="text-gray-600 mt-1">
                            Temukan kost {{ $tipe }} terbaik untuk Anda
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Total Kost -->
        @if($kosts->count() > 0)
        <div class="bg-white rounded-xl shadow-md p-4 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-home text-2xl mr-3
                        {{ $tipe == 'cewe' ? 'text-pink-600' : '' }}
                        {{ $tipe == 'cowo' ? 'text-blue-600' : '' }}
                        {{ $tipe == 'campur' ? 'text-purple-600' : '' }}"></i>
                    <span class="text-gray-700 font-semibold">
                        Ditemukan <span class="text-2xl font-bold
                            {{ $tipe == 'cewe' ? 'text-pink-600' : '' }}
                            {{ $tipe == 'cowo' ? 'text-blue-600' : '' }}
                            {{ $tipe == 'campur' ? 'text-purple-600' : '' }}">
                            {{ $kosts->count() }}
                        </span> kost {{ $tipe }}
                    </span>
                </div>
            </div>
        </div>
        @endif

        <!-- Daftar Kost -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($kosts as $kost)
            <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                
                <!-- Header Card dengan Gradient -->
                <div class="relative overflow-hidden">
                    <div class="h-48 flex items-center justify-center relative
                        {{ $tipe == 'cewe' ? 'bg-gradient-to-br from-pink-400 via-pink-500 to-pink-600' : '' }}
                        {{ $tipe == 'cowo' ? 'bg-gradient-to-br from-blue-400 via-blue-500 to-blue-600' : '' }}
                        {{ $tipe == 'campur' ? 'bg-gradient-to-br from-purple-400 via-purple-500 to-purple-600' : '' }}
                        group-hover:scale-110 transition-transform duration-500">
                        
                        <i class="fas {{ $tipe == 'cewe' ? 'fa-female' : ($tipe == 'cowo' ? 'fa-male' : 'fa-users') }} 
                           text-white text-6xl transform group-hover:scale-110 transition-transform duration-300"></i>
                        
                        <!-- Decorative circles -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"></div>
                    </div>
                    
                    <!-- Badge Tipe -->
                    <span class="absolute top-3 right-3 px-4 py-1.5 rounded-full text-xs font-bold text-white shadow-lg
                        {{ $tipe == 'cewe' ? 'bg-pink-600' : '' }}
                        {{ $tipe == 'cowo' ? 'bg-blue-600' : '' }}
                        {{ $tipe == 'campur' ? 'bg-purple-600' : '' }}">
                        {{ ucfirst($kost->tipe) }}
                    </span>
                    
                    <!-- Badge Kamar Tersedia -->
                    <div class="absolute top-3 left-3 bg-white px-3 py-1.5 rounded-full text-xs font-semibold shadow-lg">
                        <i class="fas fa-door-open text-green-600 mr-1"></i>
                        <span class="text-gray-800">
                            {{ $kost->kamars->where('status', 'tersedia')->count() }} Kamar
                        </span>
                    </div>
                </div>
                
                <!-- Body Card -->
                <div class="p-5">
                    <h3 class="font-bold text-xl text-gray-800 mb-2 group-hover:text-blue-600 transition-colors">
                        {{ $kost->nama }}
                    </h3>
                    
                    <div class="flex items-start text-gray-600 text-sm mb-3">
                        <i class="fas fa-map-marker-alt text-red-500 mr-2 mt-1"></i>
                        <span class="line-clamp-2">{{ $kost->alamat }}</span>
                    </div>
                    
                    <!-- Harga -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-3 mb-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-600 mb-1">Harga per bulan</p>
                                <p class="text-2xl font-bold text-blue-600">
                                    Rp {{ number_format($kost->harga, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="text-blue-600">
                                <i class="fas fa-tag text-3xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Fasilitas -->
                    <div class="mb-4">
                        <p class="text-xs font-semibold text-gray-700 mb-2">
                            <i class="fas fa-check-circle text-green-500 mr-1"></i>Fasilitas:
                        </p>
                        <div class="flex flex-wrap gap-2">
                            @if($kost->fasilitas)
                                @foreach(explode(',', $kost->fasilitas) as $fasilitas)
                                <span class="bg-gray-100 text-gray-700 px-3 py-1.5 rounded-lg text-xs font-medium">
                                    <i class="fas fa-check mr-1 text-green-500"></i>{{ trim($fasilitas) }}
                                </span>
                                @endforeach
                            @else
                                <span class="text-gray-400 text-xs italic">Tidak ada info fasilitas</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Daftar Kamar Tersedia (Max 3) -->
                    @if($kost->kamars->where('status', 'tersedia')->count() > 0)
                    <div class="border-t pt-4 mb-4">
                        <p class="text-xs font-semibold text-gray-700 mb-2">
                            <i class="fas fa-door-open text-blue-500 mr-1"></i>Kamar Tersedia:
                        </p>
                        <div class="space-y-2">
                            @foreach($kost->kamars->where('status', 'tersedia')->take(3) as $kamar)
                            <div class="flex items-center justify-between bg-green-50 border border-green-200 rounded-lg px-3 py-2">
                                <span class="text-sm font-medium text-gray-800">
                                    Kamar {{ $kamar->nomor }}
                                </span>
                                <span class="text-xs bg-green-500 text-white px-2 py-1 rounded-full font-semibold">
                                    Tersedia
                                </span>
                            </div>
                            @endforeach
                            
                            @if($kost->kamars->where('status', 'tersedia')->count() > 3)
                            <p class="text-xs text-gray-500 text-center mt-2">
                                +{{ $kost->kamars->where('status', 'tersedia')->count() - 3 }} kamar lainnya
                            </p>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="border-t pt-4 mb-4">
                        <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
                            <i class="fas fa-times-circle text-red-500 mr-1"></i>
                            <span class="text-sm text-red-700 font-medium">Belum ada kamar tersedia</span>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Button Detail -->
                    <a href="{{ route('penyewa.kost.detail', $kost->id) }}" 
                       class="block w-full text-center py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-lg text-white
                        {{ $tipe == 'cewe' ? 'bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700' : '' }}
                        {{ $tipe == 'cowo' ? 'bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700' : '' }}
                        {{ $tipe == 'campur' ? 'bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700' : '' }}">
                        <i class="fas fa-eye mr-2"></i>Lihat Detail & Booking
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-16">
                <div class="bg-white rounded-2xl shadow-lg p-12">
                    <i class="fas fa-home text-gray-300 text-7xl mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Kost {{ ucfirst($tipe) }}</h3>
                    <p class="text-gray-500 mb-6">Maaf, saat ini belum ada kost {{ $tipe }} yang tersedia</p>
                    <a href="{{ route('penyewa.dashboard') }}" 
                       class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Dashboard
                    </a>
                </div>
            </div>
            @endforelse
        </div>

    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection