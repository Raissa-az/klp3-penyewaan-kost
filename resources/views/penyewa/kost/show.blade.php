@extends('layouts.app')

@section('title', $kost->nama . ' - Detail Kost')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('penyewa.dashboard') }}" 
               class="inline-flex items-center text-gray-600 hover:text-gray-800 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Dashboard
            </a>
        </div>

        <!-- Header Kost -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6">
            <div class="relative h-64
                {{ $kost->tipe == 'cewe' ? 'bg-gradient-to-br from-pink-400 via-pink-500 to-pink-600' : '' }}
                {{ $kost->tipe == 'cowo' ? 'bg-gradient-to-br from-blue-400 via-blue-500 to-blue-600' : '' }}
                {{ $kost->tipe == 'campur' ? 'bg-gradient-to-br from-purple-400 via-purple-500 to-purple-600' : '' }}">
                
                <div class="absolute inset-0 flex items-center justify-center">
                    <i class="fas {{ $kost->tipe == 'cewe' ? 'fa-female' : ($kost->tipe == 'cowo' ? 'fa-male' : 'fa-users') }} 
                       text-white text-8xl"></i>
                </div>
                
                <span class="absolute top-4 right-4 px-4 py-2 rounded-full text-sm font-bold text-white shadow-lg
                    {{ $kost->tipe == 'cewe' ? 'bg-pink-700' : '' }}
                    {{ $kost->tipe == 'cowo' ? 'bg-blue-700' : '' }}
                    {{ $kost->tipe == 'campur' ? 'bg-purple-700' : '' }}">
                    {{ ucfirst($kost->tipe) }}
                </span>
            </div>
            
            <div class="p-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $kost->nama }}</h1>
                
                <div class="flex items-start text-gray-600 mb-6">
                    <i class="fas fa-map-marker-alt text-red-500 text-xl mr-3 mt-1"></i>
                    <span class="text-lg">{{ $kost->alamat }}</span>
                </div>
                
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 mb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-2">Harga per bulan</p>
                            <p class="text-4xl font-bold text-blue-600">
                                Rp {{ number_format($kost->harga, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="text-blue-600">
                            <i class="fas fa-tag text-5xl"></i>
                        </div>
                    </div>
                </div>
                
                @if($kost->fasilitas)
                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        Fasilitas Kost
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @foreach(explode(',', $kost->fasilitas) as $fasilitas)
                        <div class="bg-green-50 border-2 border-green-200 rounded-xl p-4 text-center">
                            <i class="fas fa-check text-green-500 text-xl mb-2"></i>
                            <p class="text-sm font-semibold text-gray-800">{{ trim($fasilitas) }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- CTA Button -->
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Tertarik dengan kost ini?</h2>
            <p class="text-gray-600 mb-6">Lihat kamar yang tersedia dan lakukan booking sekarang!</p>
            
            <a href="{{ route('penyewa.kost.detail', $kost->id) }}" 
               class="inline-block px-8 py-4 rounded-xl font-bold text-white transition-all duration-300 transform hover:scale-105 shadow-lg
                {{ $kost->tipe == 'cewe' ? 'bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700' : '' }}
                {{ $kost->tipe == 'cowo' ? 'bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700' : '' }}
                {{ $kost->tipe == 'campur' ? 'bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700' : '' }}">
                <i class="fas fa-door-open mr-2"></i>Lihat Kamar & Booking
            </a>
        </div>

    </div>
</div>
@endsection
