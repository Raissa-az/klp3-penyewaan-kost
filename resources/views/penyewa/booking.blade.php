@extends('layouts.app')

@section('title', 'Booking Saya - KostKu')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Booking Saya</h1>
            <p class="text-gray-600 mt-2">Kelola dan pantau status booking Anda</p>
        </div>
        
        <!-- Filter -->
        <div class="bg-white rounded-xl shadow-lg p-4 mb-6">
            <form action="{{ route('penyewa.booking') }}" method="GET" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="terbooking" {{ request('status') == 'terbooking' ? 'selected' : '' }}>Terbooking</option>
                    </select>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
            </form>
        </div>
        
        <!-- Booking List -->
        <div class="space-y-4">
            @forelse($bookings ?? [] as $booking)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition">
                <div class="md:flex">
                    <div class="md:w-1/4 p-6 flex items-center justify-center
                        {{ $booking->kost->tipe == 'cewe' ? 'bg-gradient-to-br from-pink-400 to-pink-500' : '' }}
                        {{ $booking->kost->tipe == 'cowo' ? 'bg-gradient-to-br from-blue-400 to-blue-500' : '' }}
                        {{ $booking->kost->tipe == 'campuran' ? 'bg-gradient-to-br from-purple-400 to-purple-500' : '' }}">
                        <i class="fas {{ $booking->kost->tipe == 'cewe' ? 'fa-female' : ($booking->kost->tipe == 'cowo' ? 'fa-male' : 'fa-users') }} text-white text-6xl"></i>
                    </div>
                    
                    <div class="md:w-3/4 p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">{{ $booking->kost->nama }}</h3>
                                <p class="text-gray-600 text-sm mt-1">
                                    <i class="fas fa-door-open text-blue-600 mr-1"></i>
                                    Kamar {{ $booking->kamar_nomor }}
                                </p>
                            </div>
                            <span class="px-4 py-2 rounded-full text-sm font-semibold
                                {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                <i class="fas {{ $booking->status == 'pending' ? 'fa-clock' : 'fa-check-circle' }} mr-1"></i>
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500 mb-1">Tanggal Booking</p>
                                <p class="font-semibold text-gray-800">
                                    <i class="fas fa-calendar text-blue-600 mr-2"></i>
                                    {{ $booking->created_at->format('d M Y') }}
                                </p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500 mb-1">Harga</p>
                                <p class="font-bold text-blue-600 text-lg">
                                    Rp {{ number_format($booking->kost->harga, 0, ',', '.') }}/bulan
                                </p>
                            </div>
                        </div>
                        
                        @if($booking->status == 'pending')
                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mb-4">
                            <p class="text-sm font-semibold text-yellow-800 mb-2">
                                <i class="fas fa-exclamation-triangle mr-2"></i>Menunggu Konfirmasi Pembayaran
                            </p>
                            <p class="text-xs text-gray-700">
                                Silakan hubungi admin melalui WhatsApp untuk melakukan pembayaran. Setelah pembayaran dikonfirmasi, status akan berubah menjadi Terbooking.
                            </p>
                        </div>
                        
                        <a href="https://wa.me/6281234567890?text=Halo Admin, saya ingin konfirmasi pembayaran booking kamar {{ $booking->kamar_nomor }} di {{ $booking->kost->nama }}" 
                           target="_blank"
                           class="inline-flex items-center bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-lg transition">
                            <i class="fab fa-whatsapp text-xl mr-2"></i>
                            Chat Admin di WhatsApp
                        </a>
                        @else
                        <div class="bg-green-50 border-l-4 border-green-500 p-4">
                            <p class="text-sm font-semibold text-green-800">
                                <i class="fas fa-check-circle mr-2"></i>Booking Terkonfirmasi
                            </p>
                            <p class="text-xs text-gray-700 mt-1">
                                Kamar Anda sudah terbooking. Hubungi admin jika ada pertanyaan.
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <i class="fas fa-calendar-times text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Booking</h3>
                <p class="text-gray-500 mb-6">Anda belum memiliki booking aktif</p>
                <a href="{{ route('penyewa.cari-kost') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                    <i class="fas fa-search mr-2"></i>
                    Cari Kost Sekarang
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection