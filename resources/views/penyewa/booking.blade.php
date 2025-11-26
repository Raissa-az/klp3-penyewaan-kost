@extends('layouts.app')

@section('title', 'Booking Saya - KostKu')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2 flex items-center">
                        <span class="bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-2xl w-12 h-12 flex items-center justify-center mr-4">
                            <i class="fas fa-clipboard-list"></i>
                        </span>
                        Booking Saya
                    </h1>
                    <p class="text-gray-600 text-lg ml-16">Kelola dan pantau status booking Anda</p>
                </div>
                <a href="{{ route('penyewa.dashboard') }}" 
                   class="bg-white hover:bg-gray-50 text-gray-800 font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border-2 border-gray-200">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-2xl shadow-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-medium mb-1">Pending</p>
                        <p class="text-3xl font-bold">{{ $bookings->where('status', 'pending')->count() }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-clock text-2xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-green-400 to-green-500 rounded-2xl shadow-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium mb-1">Terbooking</p>
                        <p class="text-3xl font-bold">{{ $bookings->where('status', 'terbooking')->count() }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-blue-400 to-blue-500 rounded-2xl shadow-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium mb-1">Total Booking</p>
                        <p class="text-3xl font-bold">{{ $bookings->count() }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-list text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Filter -->
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
            <form action="{{ route('penyewa.booking') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[250px]">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-filter text-blue-600 mr-2"></i>Filter Status
                    </label>
                    <select name="status" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 font-medium">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                            ⏳ Pending
                        </option>
                        <option value="terbooking" {{ request('status') == 'terbooking' ? 'selected' : '' }}>
                            ✅ Terbooking
                        </option>
                    </select>
                </div>
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                @if(request('status'))
                <a href="{{ route('penyewa.booking') }}" 
                   class="bg-red-100 hover:bg-red-200 text-red-800 font-semibold py-3.5 px-6 rounded-xl transition-colors">
                    <i class="fas fa-times mr-2"></i>Reset
                </a>
                @endif
            </form>
        </div>
        
        <!-- Booking List -->
        <div class="space-y-6">
            @forelse($bookings ?? [] as $booking)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-transparent hover:border-blue-200">
                <div class="md:flex">
                    <!-- Kost Image Section -->
                    <div class="md:w-1/3 p-8 flex items-center justify-center relative overflow-hidden
                        {{ $booking->kost->tipe == 'cewe' ? 'bg-gradient-to-br from-pink-400 via-pink-500 to-pink-600' : '' }}
                        {{ $booking->kost->tipe == 'cowo' ? 'bg-gradient-to-br from-blue-400 via-blue-500 to-blue-600' : '' }}
                        {{ $booking->kost->tipe == 'campuran' ? 'bg-gradient-to-br from-purple-400 via-purple-500 to-purple-600' : '' }}">
                        
                        <i class="fas {{ $booking->kost->tipe == 'cewe' ? 'fa-female' : ($booking->kost->tipe == 'cowo' ? 'fa-male' : 'fa-users') }} 
                           text-white text-7xl relative z-10"></i>
                        
                        <!-- Decorative circles -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"></div>
                    </div>
                    
                    <!-- Booking Details -->
                    <div class="md:w-2/3 p-6 md:p-8">
                        <!-- Header -->
                        <div class="flex justify-between items-start mb-6 flex-wrap gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="px-4 py-1.5 rounded-full text-xs font-bold
                                        {{ $booking->kost->tipe == 'cewe' ? 'bg-pink-100 text-pink-800' : '' }}
                                        {{ $booking->kost->tipe == 'cowo' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $booking->kost->tipe == 'campuran' ? 'bg-purple-100 text-purple-800' : '' }}">
                                        Kost {{ ucfirst($booking->kost->tipe) }}
                                    </span>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $booking->kost->nama }}</h3>
                                <div class="flex items-center text-gray-600 text-sm">
                                    <i class="fas fa-door-open text-blue-600 mr-2"></i>
                                    <span class="font-semibold">Kamar {{ $booking->kamar_nomor }}</span>
                                </div>
                            </div>
                            
                            <span class="px-5 py-2.5 rounded-full text-sm font-bold shadow-lg transform hover:scale-105 transition-transform
                                {{ $booking->status == 'pending' ? 'bg-gradient-to-r from-yellow-400 to-yellow-500 text-white' : '' }}
                                {{ $booking->status == 'terbooking' ? 'bg-gradient-to-r from-green-400 to-green-500 text-white' : '' }}">
                                <i class="fas {{ $booking->status == 'pending' ? 'fa-clock' : 'fa-check-circle' }} mr-2"></i>
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                        
                        <!-- Info Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-4 rounded-xl border-2 border-blue-100">
                                <p class="text-xs text-gray-600 mb-2 font-semibold">
                                    <i class="fas fa-calendar text-blue-600 mr-1"></i>Tanggal Booking
                                </p>
                                <p class="font-bold text-gray-800 text-lg">
                                    {{ $booking->created_at->format('d M Y') }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">{{ $booking->created_at->format('H:i') }} WIB</p>
                            </div>
                            
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-4 rounded-xl border-2 border-green-100">
                                <p class="text-xs text-gray-600 mb-2 font-semibold">
                                    <i class="fas fa-money-bill-wave text-green-600 mr-1"></i>Harga Sewa
                                </p>
                                <p class="font-bold text-green-600 text-2xl">
                                    Rp {{ number_format($booking->kost->harga, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">per bulan</p>
                            </div>
                        </div>
                        
                        <!-- Status Messages -->
                        @if($booking->status == 'pending')
                        <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border-l-4 border-yellow-500 p-5 rounded-r-xl mb-6 shadow-md">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-yellow-600 text-2xl mr-3"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-yellow-800 mb-2">
                                        Menunggu Konfirmasi Pembayaran
                                    </p>
                                    <p class="text-xs text-gray-700 leading-relaxed">
                                        Silakan hubungi admin melalui WhatsApp untuk melakukan pembayaran. Setelah pembayaran dikonfirmasi, status akan berubah menjadi <strong>Terbooking</strong>.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- WhatsApp Button -->
                        <a href="https://wa.me/6281234567890?text=Halo Admin KostKu,%0A%0ASaya ingin konfirmasi pembayaran booking:%0A- Kost: {{ urlencode($booking->kost->nama) }}%0A- Kamar: {{ $booking->kamar_nomor }}%0A- Harga: Rp {{ number_format($booking->kost->harga, 0, ',', '.') }}%0A%0ATerima kasih!" 
                           target="_blank"
                           class="inline-flex items-center bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <i class="fab fa-whatsapp text-2xl mr-3"></i>
                            <span>Chat Admin di WhatsApp</span>
                        </a>
                        
                        @else
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 p-5 rounded-r-xl shadow-md">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-600 text-2xl mr-3"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-green-800 mb-2">
                                        Booking Terkonfirmasi
                                    </p>
                                    <p class="text-xs text-gray-700 leading-relaxed">
                                        Selamat! Kamar Anda sudah terbooking dan siap dihuni. Hubungi admin jika ada pertanyaan lebih lanjut.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-2xl shadow-xl p-16 text-center">
                <div class="mb-6">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                        <i class="fas fa-calendar-times text-gray-400 text-4xl"></i>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-gray-700 mb-3">Belum Ada Booking</h3>
                <p class="text-gray-600 mb-8 text-lg">Anda belum memiliki booking aktif. Mulai cari kost impian Anda sekarang!</p>
                <div class="flex gap-4 justify-center flex-wrap">
                    <a href="{{ route('penyewa.cari-kost') }}" 
                       class="inline-flex items-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-search text-xl mr-3"></i>
                        <span>Cari Kost Sekarang</span>
                    </a>
                    <a href="{{ route('penyewa.dashboard') }}" 
                       class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-4 px-8 rounded-xl transition-all duration-300">
                        <i class="fas fa-home mr-2"></i>
                        <span>Kembali ke Dashboard</span>
                    </a>
                </div>
            </div>
            @endforelse
        </div>
        
        <!-- Bottom CTA -->
        @if($bookings && $bookings->count() > 0)
        <div class="mt-8 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-xl p-8 text-white text-center">
            <h3 class="text-2xl font-bold mb-3">Butuh Bantuan?</h3>
            <p class="mb-6">Tim kami siap membantu Anda 24/7 melalui WhatsApp</p>
            <a href="https://wa.me/6281234567890?text=Halo Admin KostKu, saya butuh bantuan" 
               target="_blank"
               class="inline-flex items-center bg-white text-blue-600 hover:bg-gray-100 font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <i class="fab fa-whatsapp text-xl mr-2"></i>
                Hubungi Admin
            </a>
        </div>
        @endif
    </div>
</div>
@endsection