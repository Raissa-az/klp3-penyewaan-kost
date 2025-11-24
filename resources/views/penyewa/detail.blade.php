@extends('layouts.app')

@section('title', 'Detail Kost - KostKu')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <a href="{{ route('penyewa.cari-kost') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Pencarian
        </a>
        
        <!-- Kost Info -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="md:flex">
                <div class="md:w-1/3">
                    <div class="h-full flex items-center justify-center p-12
                        {{ $kost->tipe ?? 'cewe' == 'cewe' ? 'bg-gradient-to-br from-pink-400 to-pink-500' : '' }}
                        {{ $kost->tipe ?? 'cowo' == 'cowo' ? 'bg-gradient-to-br from-blue-400 to-blue-500' : '' }}
                        {{ $kost->tipe ?? 'campuran' == 'campuran' ? 'bg-gradient-to-br from-purple-400 to-purple-500' : '' }}">
                        <i class="fas {{ $kost->tipe ?? 'cewe' == 'cewe' ? 'fa-female' : ($kost->tipe ?? 'cowo' == 'cowo' ? 'fa-male' : 'fa-users') }} text-white" style="font-size: 120px;"></i>
                    </div>
                </div>
                <div class="md:w-2/3 p-8">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <span class="inline-block px-4 py-1 rounded-full text-sm font-semibold mb-3
                                {{ $kost->tipe ?? 'cewe' == 'cewe' ? 'bg-pink-100 text-pink-800' : '' }}
                                {{ $kost->tipe ?? 'cowo' == 'cowo' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $kost->tipe ?? 'campuran' == 'campuran' ? 'bg-purple-100 text-purple-800' : '' }}">
                                Kost Khusus {{ ucfirst($kost->tipe ?? 'Cewe') }}
                            </span>
                            <h1 class="text-3xl font-bold text-gray-800">{{ $kost->nama ?? 'Kost Putri Melati' }}</h1>
                        </div>
                    </div>
                    
                    <div class="flex items-center text-gray-600 mb-4">
                        <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                        <span>{{ $kost->alamat ?? 'Jl. Sudirman No. 123, Jakarta Selatan' }}</span>
                    </div>
                    
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Harga Sewa</p>
                                <p class="text-3xl font-bold text-blue-600">Rp {{ number_format($kost->harga ?? 1500000, 0, ',', '.') }}</p>
                                <p class="text-sm text-gray-500">per bulan</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-600 mb-1">Kamar Tersedia</p>
                                <p class="text-2xl font-bold text-green-600">{{ $kost->kamar_tersedia ?? 5 }}</p>
                                <p class="text-sm text-gray-500">dari {{ $kost->total_kamar ?? 5 }} kamar</p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-3">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>Fasilitas
                        </h3>
                        <div class="grid grid-cols-2 gap-3">
                            @if($kost->tipe ?? 'cewe' == 'cewe')
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-bed text-blue-500 mr-2"></i>Kasur
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-bath text-blue-500 mr-2"></i>Kamar Mandi Dalam
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-wind text-blue-500 mr-2"></i>Kipas Angin
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-utensils text-blue-500 mr-2"></i>Dapur Sharing
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-door-closed text-blue-500 mr-2"></i>Lemari
                                </div>
                            @elseif($kost->tipe ?? 'cowo' == 'cowo')
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-bed text-blue-500 mr-2"></i>Kasur
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-bath text-blue-500 mr-2"></i>Kamar Mandi Sharing
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-utensils text-blue-500 mr-2"></i>Dapur Sharing
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-door-closed text-blue-500 mr-2"></i>Lemari
                                </div>
                            @else
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-bath text-blue-500 mr-2"></i>Kamar Mandi Dalam
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-ban text-red-500 mr-2"></i>Fasilitas Kosong
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Daftar Kamar -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                <i class="fas fa-door-open text-blue-600 mr-2"></i>Daftar Kamar
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @for($i = 1; $i <= 5; $i++)
                @php
                    $status = $i <= 3 ? 'tersedia' : 'terbooking';
                @endphp
                <div class="border rounded-lg p-6 {{ $status == 'tersedia' ? 'bg-white hover:shadow-lg' : 'bg-gray-50' }} transition">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Kamar {{ $i }}</h3>
                            <p class="text-sm text-gray-500">Lantai {{ ceil($i/2) }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $status == 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            <i class="fas {{ $status == 'tersedia' ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                            {{ ucfirst($status) }}
                        </span>
                    </div>
                    
                    <div class="mb-4">
                        <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                            <span><i class="fas fa-ruler-combined text-blue-500 mr-2"></i>Ukuran</span>
                            <span class="font-semibold">3x4 m</span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <span><i class="fas fa-money-bill text-green-500 mr-2"></i>Harga</span>
                            <span class="font-bold text-blue-600">Rp {{ number_format($kost->harga ?? 1500000, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    @if($status == 'tersedia')
                        <button onclick="openBookingModal({{ $i }})" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                            <i class="fas fa-calendar-check mr-2"></i>Booking Sekarang
                        </button>
                    @else
                        <button disabled 
                                class="w-full bg-gray-300 text-gray-500 font-semibold py-2 px-4 rounded-lg cursor-not-allowed">
                            <i class="fas fa-lock mr-2"></i>Tidak Tersedia
                        </button>
                    @endif
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>

<!-- Booking Modal -->
<div id="bookingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" x-data="{ open: false }">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-6 text-white">
            <h3 class="text-2xl font-bold">
                <i class="fas fa-calendar-check mr-2"></i>Konfirmasi Booking
            </h3>
        </div>
        
        <form action="{{ route('penyewa.booking.store') }}" method="POST" class="p-6">
            @csrf
            <input type="hidden" name="kost_id" value="{{ $kost->id ?? 1 }}">
            <input type="hidden" name="kamar_nomor" id="kamar_nomor">
            
            <div class="mb-6">
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
                    <p class="text-sm text-gray-600 mb-1">Detail Booking</p>
                    <p class="font-semibold text-gray-800">Kamar <span id="modal_kamar_nomor"></span></p>
                    <p class="text-sm text-gray-600">{{ $kost->nama ?? 'Kost Putri Melati' }}</p>
                </div>
                
                <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4">
                    <p class="text-sm font-semibold text-yellow-800 mb-2">
                        <i class="fas fa-info-circle mr-2"></i>Informasi Penting
                    </p>
                    <ul class="text-sm text-gray-700 space-y-1">
                        <li>• Status booking akan <strong>PENDING</strong> setelah konfirmasi</li>
                        <li>• Hubungi admin melalui WhatsApp untuk pembayaran</li>
                        <li>• Status menjadi <strong>TERBOOKING</strong> setelah admin konfirmasi</li>
                    </ul>
                </div>
            </div>
            
            <div class="flex space-x-3">
                <button type="button" onclick="closeBookingModal()" 
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-4 rounded-lg transition">
                    Batal
                </button>
                <button type="submit" 
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition">
                    <i class="fas fa-check mr-2"></i>Konfirmasi
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openBookingModal(kamarNomor) {
    document.getElementById('kamar_nomor').value = kamarNomor;
    document.getElementById('modal_kamar_nomor').textContent = kamarNomor;
    document.getElementById('bookingModal').classList.remove('hidden');
    document.getElementById('bookingModal').classList.add('flex');
}

function closeBookingModal() {
    document.getElementById('bookingModal').classList.add('hidden');
    document.getElementById('bookingModal').classList.remove('flex');
}
</script>
@endpush
@endsection