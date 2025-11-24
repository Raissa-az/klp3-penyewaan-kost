@extends('layouts.app')

@section('title', 'Admin Dashboard - KostKu')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
            <p class="text-gray-600 mt-2">Selamat datang, {{ auth()->user()->name }}! Kelola sistem kost Anda dengan mudah.</p>
        </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Kost -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium mb-1">Total Kost</p>
                        <h3 class="text-4xl font-bold">{{ $totalKost ?? 3 }}</h3>
                        <p class="text-blue-100 text-xs mt-2">3 Tipe Kost</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-building text-4xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Total Kamar -->
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium mb-1">Total Kamar</p>
                        <h3 class="text-4xl font-bold">{{ $totalKamar ?? 15 }}</h3>
                        <p class="text-purple-100 text-xs mt-2">Semua Kost</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-door-open text-4xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Kamar Tersedia -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium mb-1">Kamar Tersedia</p>
                        <h3 class="text-4xl font-bold">{{ $kamarTersedia ?? 8 }}</h3>
                        <p class="text-green-100 text-xs mt-2">Siap Disewa</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-check-circle text-4xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Booking Pending -->
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-medium mb-1">Booking Pending</p>
                        <h3 class="text-4xl font-bold">{{ $bookingPending ?? 2 }}</h3>
                        <p class="text-orange-100 text-xs mt-2">Perlu Konfirmasi</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-clock text-4xl"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Booking Terbaru -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800">
                        <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>Booking Terbaru
                    </h2>
                    <a href="{{ route('admin.booking.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                
                <div class="space-y-4">
                    @forelse($bookingTerbaru ?? [] as $booking)
                    <div class="border-l-4 {{ $booking->status == 'pending' ? 'border-orange-500 bg-orange-50' : 'border-green-500 bg-green-50' }} p-4 rounded">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="font-semibold text-gray-800">{{ $booking->user->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $booking->kost->nama }} - Kamar {{ $booking->kamar_nomor }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $booking->status == 'pending' ? 'bg-orange-200 text-orange-800' : 'bg-green-200 text-green-800' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-500">{{ $booking->created_at->diffForHumans() }}</p>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                        <p class="text-gray-500">Belum ada booking</p>
                    </div>
                    @endforelse
                </div>
            </div>
            
            <!-- Statistik Kost -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">
                    <i class="fas fa-chart-bar text-blue-600 mr-2"></i>Statistik Kost
                </h2>
                
                <div class="space-y-4">
                    <!-- Kost Cewe -->
                    <div class="border-l-4 border-pink-500 bg-pink-50 p-4 rounded">
                        <div class="flex justify-between items-center mb-2">
                            <div>
                                <h3 class="font-semibold text-gray-800">Kost Khusus Cewe</h3>
                                <p class="text-sm text-gray-600">Jl. Sudirman No. 123</p>
                            </div>
                            <i class="fas fa-female text-pink-500 text-3xl"></i>
                        </div>
                        <div class="flex items-center justify-between mt-3">
                            <span class="text-xs text-gray-600">Occupancy</span>
                            <span class="text-sm font-bold text-pink-600">3/5 Kamar</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                            <div class="bg-pink-500 h-2 rounded-full" style="width: 60%"></div>
                        </div>
                    </div>
                    
                    <!-- Kost Cowo -->
                    <div class="border-l-4 border-blue-500 bg-blue-50 p-4 rounded">
                        <div class="flex justify-between items-center mb-2">
                            <div>
                                <h3 class="font-semibold text-gray-800">Kost Khusus Cowo</h3>
                                <p class="text-sm text-gray-600">Jl. Gatot Subroto No. 45</p>
                            </div>
                            <i class="fas fa-male text-blue-500 text-3xl"></i>
                        </div>
                        <div class="flex items-center justify-between mt-3">
                            <span class="text-xs text-gray-600">Occupancy</span>
                            <span class="text-sm font-bold text-blue-600">2/5 Kamar</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 40%"></div>
                        </div>
                    </div>
                    
                    <!-- Kost Campuran -->
                    <div class="border-l-4 border-purple-500 bg-purple-50 p-4 rounded">
                        <div class="flex justify-between items-center mb-2">
                            <div>
                                <h3 class="font-semibold text-gray-800">Kost Campuran</h3>
                                <p class="text-sm text-gray-600">Jl. Thamrin No. 78</p>
                            </div>
                            <i class="fas fa-users text-purple-500 text-3xl"></i>
                        </div>
                        <div class="flex items-center justify-between mt-3">
                            <span class="text-xs text-gray-600">Occupancy</span>
                            <span class="text-sm font-bold text-purple-600">2/5 Kamar</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: 40%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('admin.kamar.create') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition">
                <i class="fas fa-plus-circle text-4xl mb-3"></i>
                <h3 class="text-lg font-bold">Tambah Kamar Baru</h3>
                <p class="text-sm text-blue-100 mt-1">Tambahkan kamar kost baru</p>
            </a>
            
            <a href="{{ route('admin.booking.index') }}" class="bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition">
                <i class="fas fa-tasks text-4xl mb-3"></i>
                <h3 class="text-lg font-bold">Kelola Booking</h3>
                <p class="text-sm text-green-100 mt-1">Konfirmasi pembayaran booking</p>
            </a>
            
            <a href="{{ route('admin.kamar.index') }}" class="bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition">
                <i class="fas fa-door-open text-4xl mb-3"></i>
                <h3 class="text-lg font-bold">Kelola Kamar</h3>
                <p class="text-sm text-orange-100 mt-1">Update status dan data kamar</p>
            </a>
        </div>
    </div>
</div>
@endsection