@extends('layouts.app')

@section('title', $kost->nama . ' - Detail Kost')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('penyewa.kost.tipe', $kost->tipe) }}" 
               class="inline-flex items-center text-gray-600 hover:text-gray-800 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Daftar Kost {{ ucfirst($kost->tipe) }}
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
                
                <!-- Badge Tipe -->
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
                
                <!-- Fasilitas -->
                @if($kost->fasilitas)
                <div class="mb-6">
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

        <!-- Daftar Kamar -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-door-open mr-3
                    {{ $kost->tipe == 'cewe' ? 'text-pink-600' : '' }}
                    {{ $kost->tipe == 'cowo' ? 'text-blue-600' : '' }}
                    {{ $kost->tipe == 'campur' ? 'text-purple-600' : '' }}"></i>
                Daftar Kamar ({{ $kost->kamars->count() }} Kamar)
            </h2>
            
            @if($kost->kamars->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($kost->kamars as $kamar)
                <div class="border-2 rounded-2xl overflow-hidden transition-all duration-300 transform hover:scale-105
                    {{ $kamar->status == 'tersedia' ? 'border-green-300 hover:shadow-xl' : 'border-gray-200 opacity-60' }}">
                    
                    <div class="p-6
                        {{ $kamar->status == 'tersedia' ? 'bg-gradient-to-br from-green-50 to-green-100' : 'bg-gray-50' }}">
                        
                        <!-- Header Kamar -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center mr-3
                                    {{ $kamar->status == 'tersedia' ? 'bg-green-500' : 'bg-gray-400' }}">
                                    <i class="fas fa-door-open text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">
                                        Kamar {{ $kamar->nomor }}
                                    </h3>
                                </div>
                            </div>
                            
                            <span class="px-3 py-1.5 rounded-full text-xs font-bold
                                {{ $kamar->status == 'tersedia' ? 'bg-green-500 text-white' : '' }}
                                {{ $kamar->status == 'menunggu' ? 'bg-yellow-500 text-white' : '' }}
                                {{ $kamar->status == 'terbooking' ? 'bg-blue-500 text-white' : '' }}
                                {{ $kamar->status == 'tidak_tersedia' ? 'bg-red-500 text-white' : '' }}">
                                {{ ucfirst($kamar->status) }}
                            </span>
                        </div>
                        
                        <!-- Info Kamar -->
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-money-bill-wave text-green-600 mr-2"></i>
                                <span class="font-semibold">Rp {{ number_format($kost->harga, 0, ',', '.') }}/bulan</span>
                            </div>
                        </div>
                        
                        <!-- Tombol Booking -->
                        @if($kamar->status == 'tersedia')
                        <form action="{{ route('penyewa.booking.whatsapp') }}" method="POST">
                            @csrf
                            <input type="hidden" name="kamar_id" value="{{ $kamar->id }}">
                            <input type="hidden" name="nama_penyewa" value="{{ auth()->user()->name }}">
                            
                            <button type="submit" 
                                    class="w-full py-3 rounded-xl font-bold text-white transition-all duration-300 transform hover:scale-105 shadow-lg
                                    {{ $kost->tipe == 'cewe' ? 'bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700' : '' }}
                                    {{ $kost->tipe == 'cowo' ? 'bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700' : '' }}
                                    {{ $kost->tipe == 'campur' ? 'bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700' : '' }}">
                                <i class="fab fa-whatsapp mr-2"></i>Booking via WhatsApp
                            </button>
                        </form>
                        @else
                        <button disabled 
                                class="w-full py-3 rounded-xl font-bold text-white bg-gray-400 cursor-not-allowed">
                            <i class="fas fa-times-circle mr-2"></i>Tidak Tersedia
                        </button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12 bg-gray-50 rounded-xl">
                <i class="fas fa-door-closed text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-lg font-medium">Belum ada kamar yang ditambahkan</p>
                <p class="text-gray-400 text-sm mt-2">Silakan hubungi admin untuk informasi lebih lanjut</p>
            </div>
            @endif
        </div>

    </div>
</div>
@endsection