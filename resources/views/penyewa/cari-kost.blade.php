@extends('layouts.app')

@section('title', 'Cari Kost - KostKu')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Cari Kost</h1>
            <p class="text-gray-600 mt-2">Temukan kost yang sesuai dengan kebutuhan Anda</p>
        </div>
        
        <!-- Filter -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <form action="{{ route('penyewa.cari-kost') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Tipe Kost -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-home text-blue-600 mr-1"></i>Tipe Kost
                    </label>
                    <select name="tipe" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Tipe</option>
                        <option value="cewe" {{ request('tipe') == 'cewe' ? 'selected' : '' }}>Khusus Cewe</option>
                        <option value="cowo" {{ request('tipe') == 'cowo' ? 'selected' : '' }}>Khusus Cowo</option>
                        <option value="campuran" {{ request('tipe') == 'campuran' ? 'selected' : '' }}>Campuran</option>
                    </select>
                </div>
                
                <!-- Harga Min -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-money-bill text-green-600 mr-1"></i>Harga Min
                    </label>
                    <input type="number" name="harga_min" value="{{ request('harga_min') }}" placeholder="500000"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <!-- Harga Max -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-money-bill text-green-600 mr-1"></i>Harga Max
                    </label>
                    <input type="number" name="harga_max" value="{{ request('harga_max') }}" placeholder="2000000"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <!-- Button -->
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Results -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($kostList ?? [] as $kost)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition group">
                <div class="relative">
                    <div class="h-48 flex items-center justify-center
                        {{ $kost->tipe == 'cewe' ? 'bg-gradient-to-r from-pink-400 to-pink-500' : '' }}
                        {{ $kost->tipe == 'cowo' ? 'bg-gradient-to-r from-blue-400 to-blue-500' : '' }}
                        {{ $kost->tipe == 'campuran' ? 'bg-gradient-to-r from-purple-400 to-purple-500' : '' }}">
                        <i class="fas {{ $kost->tipe == 'cewe' ? 'fa-female' : ($kost->tipe == 'cowo' ? 'fa-male' : 'fa-users') }} text-white text-6xl"></i>
                    </div>
                    <span class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-semibold text-white
                        {{ $kost->tipe == 'cewe' ? 'bg-pink-500' : '' }}
                        {{ $kost->tipe == 'cowo' ? 'bg-blue-500' : '' }}
                        {{ $kost->tipe == 'campuran' ? 'bg-purple-500' : '' }}">
                        {{ ucfirst($kost->tipe) }}
                    </span>
                    <div class="absolute top-3 left-3">
                        <span class="bg-white text-gray-800 px-3 py-1 rounded-full text-xs font-semibold">
                            <i class="fas fa-door-open text-green-600 mr-1"></i>
                            {{ $kost->kamar_tersedia ?? 5 }} Tersedia
                        </span>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="font-bold text-xl text-gray-800 mb-2">{{ $kost->nama }}</h3>
                    
                    <div class="flex items-start text-gray-600 text-sm mb-3">
                        <i class="fas fa-map-marker-alt mt-1 mr-2 
                            {{ $kost->tipe == 'cewe' ? 'text-pink-500' : '' }}
                            {{ $kost->tipe == 'cowo' ? 'text-blue-500' : '' }}
                            {{ $kost->tipe == 'campuran' ? 'text-purple-500' : '' }}"></i>
                        <span>{{ $kost->alamat }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-blue-600 font-bold text-2xl">Rp {{ number_format($kost->harga, 0, ',', '.') }}</span>
                            <span class="text-gray-500 text-sm">/bulan</span>
                        </div>
                    </div>
                    
                    <!-- Fasilitas -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(explode(',', $kost->fasilitas ?? '') as $fasilitas)
                            @if(trim($fasilitas))
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                                <i class="fas fa-check mr-1"></i>{{ trim($fasilitas) }}
                            </span>
                            @endif
                        @endforeach
                    </div>
                    
                    <a href="{{ route('penyewa.detail', $kost->id) }}" 
                       class="block w-full text-center py-3 rounded-lg font-semibold transition
                        {{ $kost->tipe == 'cewe' ? 'bg-pink-500 hover:bg-pink-600' : '' }}
                        {{ $kost->tipe == 'cowo' ? 'bg-blue-500 hover:bg-blue-600' : '' }}
                        {{ $kost->tipe == 'campuran' ? 'bg-purple-500 hover:bg-purple-600' : '' }}
                        text-white">
                        <i class="fas fa-eye mr-2"></i>Lihat Detail
                    </a>
                </div>
            </div>
            @empty
            <!-- Default Data (3 Kost) -->
            <!-- Kost Cewe -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition">
                <div class="relative">
                    <div class="bg-gradient-to-r from-pink-400 to-pink-500 h-48 flex items-center justify-center">
                        <i class="fas fa-female text-white text-6xl"></i>
                    </div>
                    <span class="absolute top-3 right-3 bg-pink-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                        Khusus Cewe
                    </span>
                    <div class="absolute top-3 left-3">
                        <span class="bg-white text-gray-800 px-3 py-1 rounded-full text-xs font-semibold">
                            <i class="fas fa-door-open text-green-600 mr-1"></i>5 Tersedia
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-xl text-gray-800 mb-2">Kost Putri Melati</h3>
                    <div class="flex items-start text-gray-600 text-sm mb-3">
                        <i class="fas fa-map-marker-alt text-pink-500 mt-1 mr-2"></i>
                        <span>Jl. Sudirman No. 123, Jakarta Selatan</span>
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-blue-600 font-bold text-2xl">Rp 1.500.000</span>
                            <span class="text-gray-500 text-sm">/bulan</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                            <i class="fas fa-bed mr-1"></i>Kasur
                        </span>
                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                            <i class="fas fa-bath mr-1"></i>KM Dalam
                        </span>
                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                            <i class="fas fa-wind mr-1"></i>Kipas
                        </span>
                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                            <i class="fas fa-utensils mr-1"></i>Dapur
                        </span>
                    </div>
                    <a href="{{ route('penyewa.detail', 1) }}" 
                       class="block w-full bg-pink-500 hover:bg-pink-600 text-white text-center py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-eye mr-2"></i>Lihat Detail
                    </a>
                </div>
            </div>
            
            <!-- Kost Cowo -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition">
                <div class="relative">
                    <div class="bg-gradient-to-r from-blue-400 to-blue-500 h-48 flex items-center justify-center">
                        <i class="fas fa-male text-white text-6xl"></i>
                    </div>
                    <span class="absolute top-3 right-3 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                        Khusus Cowo
                    </span>
                    <div class="absolute top-3 left-3">
                        <span class="bg-white text-gray-800 px-3 py-1 rounded-full text-xs font-semibold">
                            <i class="fas fa-door-open text-green-600 mr-1"></i>5 Tersedia
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-xl text-gray-800 mb-2">Kost Putra Wijaya</h3>
                    <div class="flex items-start text-gray-600 text-sm mb-3">
                        <i class="fas fa-map-marker-alt text-blue-500 mt-1 mr-2"></i>
                        <span>Jl. Gatot Subroto No. 45, Jakarta Pusat</span>
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-blue-600 font-bold text-2xl">Rp 1.200.000</span>
                            <span class="text-gray-500 text-sm">/bulan</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-4">
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
                    <a href="{{ route('penyewa.detail', 2) }}" 
                       class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-eye mr-2"></i>Lihat Detail
                    </a>
                </div>
            </div>
            
            <!-- Kost Campuran -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition">
                <div class="relative">
                    <div class="bg-gradient-to-r from-purple-400 to-purple-500 h-48 flex items-center justify-center">
                        <i class="fas fa-users text-white text-6xl"></i>
                    </div>
                    <span class="absolute top-3 right-3 bg-purple-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                        Campuran
                    </span>
                    <div class="absolute top-3 left-3">
                        <span class="bg-white text-gray-800 px-3 py-1 rounded-full text-xs font-semibold">
                            <i class="fas fa-door-open text-green-600 mr-1"></i>5 Tersedia
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-xl text-gray-800 mb-2">Kost Harmoni</h3>
                    <div class="flex items-start text-gray-600 text-sm mb-3">
                        <i class="fas fa-map-marker-alt text-purple-500 mt-1 mr-2"></i>
                        <span>Jl. Thamrin No. 78, Jakarta Utara</span>
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-blue-600 font-bold text-2xl">Rp 1.000.000</span>
                            <span class="text-gray-500 text-sm">/bulan</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                            <i class="fas fa-bath mr-1"></i>KM Dalam
                        </span>
                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                            <i class="fas fa-ban mr-1"></i>Fasilitas Kosong
                        </span>
                    </div>
                    <a href="{{ route('penyewa.detail', 3) }}" 
                       class="block w-full bg-purple-500 hover:bg-purple-600 text-white text-center py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-eye mr-2"></i>Lihat Detail
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection