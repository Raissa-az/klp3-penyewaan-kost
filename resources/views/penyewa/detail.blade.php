@extends('layouts.app')

@section('title', isset($kost) ? 'Detail ' . $kost->nama . ' - KostKu' : 'Detail Kost - KostKu')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Back Button -->
        <a href="{{ route('penyewa.cari-kost') }}" 
           class="inline-flex items-center bg-white hover:bg-gray-50 text-gray-800 font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 mb-6 border-2 border-gray-200">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Pencarian
        </a>

        @if(isset($kost) && $kost)
        @php
            $colors = [
                'cewe' => [
                    'gradient' => 'from-pink-400 via-pink-500 to-pink-600',
                    'icon' => 'fa-female',
                    'badge' => 'bg-pink-600',
                    'badgeLight' => 'bg-pink-100 text-pink-800',
                    'border' => 'border-pink-500',
                    'button' => 'from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700',
                    'text' => 'text-pink-600'
                ],
                'cowo' => [
                    'gradient' => 'from-blue-400 via-blue-500 to-blue-600',
                    'icon' => 'fa-male',
                    'badge' => 'bg-blue-600',
                    'badgeLight' => 'bg-blue-100 text-blue-800',
                    'border' => 'border-blue-500',
                    'button' => 'from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700',
                    'text' => 'text-blue-600'
                ],
                'campuran' => [
                    'gradient' => 'from-purple-400 via-purple-500 to-purple-600',
                    'icon' => 'fa-users',
                    'badge' => 'bg-purple-600',
                    'badgeLight' => 'bg-purple-100 text-purple-800',
                    'border' => 'border-purple-500',
                    'button' => 'from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700',
                    'text' => 'text-purple-600'
                ],
            ];
            $type = $kost->tipe ?? 'campuran';
            $color = $colors[$type];
            
            // Fasilitas berdasarkan tipe kost
            $fasilitasDefault = [
                'cewe' => [
                    ['icon' => 'fa-bed', 'text' => 'Kasur', 'color' => 'text-pink-600'],
                    ['icon' => 'fa-bath', 'text' => 'Kamar Mandi Dalam', 'color' => 'text-blue-600'],
                    ['icon' => 'fa-utensils', 'text' => 'Dapur Sharing', 'color' => 'text-orange-600'],
                    ['icon' => 'fa-snowflake', 'text' => 'Kipas Angin', 'color' => 'text-cyan-600'],
                    ['icon' => 'fa-door-closed', 'text' => 'Lemari', 'color' => 'text-brown-600'],
                ],
                'cowo' => [
                    ['icon' => 'fa-bed', 'text' => 'Kasur', 'color' => 'text-blue-600'],
                    ['icon' => 'fa-bath', 'text' => 'Kamar Mandi Sharing', 'color' => 'text-blue-600'],
                    ['icon' => 'fa-utensils', 'text' => 'Dapur Sharing', 'color' => 'text-orange-600'],
                    ['icon' => 'fa-door-closed', 'text' => 'Lemari', 'color' => 'text-brown-600'],
                ],
                'campuran' => [
                    ['icon' => 'fa-bath', 'text' => 'Kamar Mandi Dalam', 'color' => 'text-blue-600'],
                    ['icon' => 'fa-times-circle', 'text' => 'Fasilitas Kosong (Unfurnished)', 'color' => 'text-red-600'],
                ],
            ];
            $fasilitas = $fasilitasDefault[$type] ?? [];
        @endphp

        <!-- Main Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden mb-8 border-2 border-gray-100">
            <div class="md:flex">

                <!-- Kost Icon Section -->
                <div class="md:w-2/5 relative overflow-hidden">
                    <div class="h-full min-h-[400px] flex items-center justify-center p-12 bg-gradient-to-br {{ $color['gradient'] }} relative">
                        <i class="fas {{ $color['icon'] }} text-white relative z-10 transform hover:scale-110 transition-transform duration-300" 
                           style="font-size: 140px;"></i>
                        
                        <!-- Decorative elements -->
                        <div class="absolute top-0 right-0 w-40 h-40 bg-white opacity-10 rounded-full -mr-20 -mt-20"></div>
                        <div class="absolute bottom-0 left-0 w-32 h-32 bg-white opacity-10 rounded-full -ml-16 -mb-16"></div>
                        <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-white opacity-5 rounded-full -ml-32 -mt-32"></div>
                    </div>
                </div>

                <!-- Kost Details Section -->
                <div class="md:w-3/5 p-8 md:p-10">
                    <!-- Header -->
                    <div class="mb-6">
                        <span class="inline-block px-5 py-2 rounded-full text-sm font-bold mb-4 {{ $color['badgeLight'] }} shadow-md">
                            <i class="fas {{ $color['icon'] }} mr-2"></i>
                            Kost {{ ucfirst($type) }}
                        </span>
                        <h1 class="text-4xl font-bold text-gray-800 mb-3">{{ $kost->nama ?? '-' }}</h1>
                        <div class="flex items-start text-gray-600 mb-2">
                            <i class="fas fa-map-marker-alt text-red-500 mr-3 mt-1 text-xl"></i>
                            <span class="text-lg">{{ $kost->alamat ?? '-' }}</span>
                        </div>
                    </div>

                    <!-- Price & Availability Card -->
                    <div class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 border-l-4 {{ $color['border'] }} p-6 rounded-xl mb-6 shadow-lg">
                        <div class="flex items-center justify-between flex-wrap gap-6">
                            <div class="flex-1">
                                <p class="text-sm text-gray-600 mb-2 font-semibold flex items-center">
                                    <i class="fas fa-tag {{ $color['text'] }} mr-2"></i>
                                    Harga Sewa
                                </p>
                                <p class="text-4xl font-bold {{ $color['text'] }} mb-1">
                                    Rp {{ number_format($kost->harga ?? 0, 0, ',', '.') }}
                                </p>
                                <p class="text-sm text-gray-500 font-medium">per bulan</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-600 mb-2 font-semibold flex items-center justify-end">
                                    <i class="fas fa-door-open text-green-600 mr-2"></i>
                                    Ketersediaan
                                </p>
                                <p class="text-3xl font-bold text-green-600 mb-1">{{ $kost->kamar_tersedia ?? 0 }}</p>
                                <p class="text-sm text-gray-500 font-medium">dari {{ $kost->total_kamar ?? 0 }} kamar</p>
                            </div>
                        </div>
                    </div>

                    <!-- Fasilitas -->
                    <div class="mb-6">
                        <h3 class="font-bold text-xl text-gray-800 mb-4 flex items-center">
                            <div class="bg-green-100 text-green-600 rounded-full w-8 h-8 flex items-center justify-center mr-3">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            Fasilitas Kamar
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($fasilitas as $item)
                            <div class="flex items-center bg-gray-50 hover:bg-gray-100 p-4 rounded-xl transition-colors border-2 border-gray-100">
                                <div class="bg-white rounded-full w-12 h-12 flex items-center justify-center mr-4 shadow-md">
                                    <i class="fas {{ $item['icon'] }} {{ $item['color'] }} text-xl"></i>
                                </div>
                                <span class="text-gray-700 font-semibold">{{ $item['text'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Quick Info -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-xl text-center border-2 border-blue-200">
                            <i class="fas fa-wifi text-blue-600 text-2xl mb-2"></i>
                            <p class="text-xs text-gray-600 font-semibold">WiFi Area</p>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-xl text-center border-2 border-green-200">
                            <i class="fas fa-shield-alt text-green-600 text-2xl mb-2"></i>
                            <p class="text-xs text-gray-600 font-semibold">Keamanan 24/7</p>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <div class="flex gap-4">
                        <button onclick="window.scrollTo({top: document.getElementById('daftar-kamar').offsetTop - 100, behavior: 'smooth'})"
                                class="flex-1 bg-gradient-to-r {{ $color['button'] }} text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-bed mr-2"></i>Lihat Daftar Kamar
                        </button>
                        <a href="https://wa.me/6281234567890?text=Halo Admin, saya tertarik dengan {{ urlencode($kost->nama) }}" 
                           target="_blank"
                           class="flex items-center justify-center bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-shadow border-2 border-gray-100">
                <div class="bg-gradient-to-br from-blue-100 to-blue-200 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-blue-600 text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">Akses 24 Jam</h4>
                <p class="text-sm text-gray-600">Bebas keluar masuk kapan saja</p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-shadow border-2 border-gray-100">
                <div class="bg-gradient-to-br from-green-100 to-green-200 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-parking text-green-600 text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">Parkir Luas</h4>
                <p class="text-sm text-gray-600">Area parkir motor & mobil</p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-shadow border-2 border-gray-100">
                <div class="bg-gradient-to-br from-purple-100 to-purple-200 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map-marked-alt text-purple-600 text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">Lokasi Strategis</h4>
                <p class="text-sm text-gray-600">Dekat kampus & fasilitas umum</p>
            </div>
        </div>

        <!-- Daftar Kamar Section -->
        <div id="daftar-kamar">
            @includeIf('penyewa.components.daftar-kamar', ['kost' => $kost, 'color' => $color])
        </div>

        <!-- Modal Booking -->
        @includeIf('penyewa.components.modal-booking', ['kost' => $kost, 'color' => $color])

        <!-- Contact Admin Banner -->
        <div class="mt-8 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-2xl shadow-2xl p-8 text-white text-center overflow-hidden relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full -ml-24 -mb-24"></div>
            <div class="relative z-10">
                <h3 class="text-3xl font-bold mb-3">Punya Pertanyaan?</h3>
                <p class="mb-6 text-lg">Tim kami siap membantu Anda menemukan kost yang tepat</p>
                <a href="https://wa.me/6281234567890?text=Halo Admin KostKu, saya ingin bertanya tentang {{ urlencode($kost->nama) }}" 
                   target="_blank"
                   class="inline-flex items-center bg-white text-blue-600 hover:bg-gray-100 font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fab fa-whatsapp text-2xl mr-3"></i>
                    <span>Hubungi Admin Sekarang</span>
                </a>
            </div>
        </div>

        @else
        <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
            <i class="fas fa-exclamation-triangle text-red-400 text-6xl mb-6"></i>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Data Kost Tidak Ditemukan</h3>
            <p class="text-gray-600 mb-6">Maaf, kost yang Anda cari tidak tersedia</p>
            <a href="{{ route('penyewa.cari-kost') }}" 
               class="inline-flex items-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-search mr-2"></i>
                Cari Kost Lainnya
            </a>
        </div>
        @endif

    </div>
</div>
@endsection