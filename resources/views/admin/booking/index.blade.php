@extends('layouts.app')

@section('title', 'Kelola Booking - Admin')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Kelola Booking</h1>
            <p class="text-gray-600 mt-2">Konfirmasi pembayaran dan kelola status booking</p>
        </div>
        
        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-medium mb-1">Pending</p>
                        <h3 class="text-3xl font-bold">{{ $pendingCount ?? 2 }}</h3>
                    </div>
                    <i class="fas fa-clock text-4xl opacity-50"></i>
                </div>
            </div>
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium mb-1">Terbooking</p>
                        <h3 class="text-3xl font-bold">{{ $terbookingCount ?? 5 }}</h3>
                    </div>
                    <i class="fas fa-check-circle text-4xl opacity-50"></i>
                </div>
            </div>
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium mb-1">Total</p>
                        <h3 class="text-3xl font-bold">{{ $totalCount ?? 7 }}</h3>
                    </div>
                    <i class="fas fa-calendar-alt text-4xl opacity-50"></i>
                </div>
            </div>
        </div>
        
        <!-- Filter -->
        <div class="bg-white rounded-xl shadow-lg p-4 mb-6">
            <form action="{{ route('admin.booking.index') }}" method="GET" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="terbooking" {{ request('status') == 'terbooking' ? 'selected' : '' }}>Terbooking</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <select name="kost_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Kost</option>
                        <option value="1">Kost Putri Melati</option>
                        <option value="2">Kost Putra Wijaya</option>
                        <option value="3">Kost Harmoni</option>
                    </select>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
            </form>
        </div>
        
        <!-- Booking List -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Penyewa</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Kost & Kamar</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Harga</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Booking Pending Example -->
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                        <span class="text-blue-600 font-bold">JD</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">John Doe</p>
                                        <p class="text-sm text-gray-500">john@email.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-gray-800">Kost Putri Melati</p>
                                    <p class="text-sm text-gray-600">
                                        <i class="fas fa-door-open text-blue-600 mr-1"></i>Kamar 1
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600">24 Nov 2025</p>
                                <p class="text-xs text-gray-500">14:30</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-blue-600">Rp 1.500.000</p>
                                <p class="text-xs text-gray-500">/bulan</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-800">
                                    <i class="fas fa-clock mr-1"></i>Pending
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="https://wa.me/6281234567890" target="_blank"
                                       class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm transition inline-flex items-center">
                                        <i class="fab fa-whatsapp mr-1"></i>Chat
                                    </a>
                                    <form action="{{ route('admin.booking.update-status', 1) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="terbooking">
                                        <button type="submit" onclick="return confirm('Konfirmasi pembayaran telah diterima?')"
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm transition">
                                            <i class="fas fa-check mr-1"></i>Konfirmasi
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Booking Pending Example 2 -->
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-pink-100 flex items-center justify-center mr-3">
                                        <span class="text-pink-600 font-bold">JS</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">Jane Smith</p>
                                        <p class="text-sm text-gray-500">jane@email.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-gray-800">Kost Putra Wijaya</p>
                                    <p class="text-sm text-gray-600">
                                        <i class="fas fa-door-open text-blue-600 mr-1"></i>Kamar 3
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600">23 Nov 2025</p>
                                <p class="text-xs text-gray-500">10:15</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-blue-600">Rp 1.200.000</p>
                                <p class="text-xs text-gray-500">/bulan</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-800">
                                    <i class="fas fa-clock mr-1"></i>Pending
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="https://wa.me/6281234567890" target="_blank"
                                       class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm transition inline-flex items-center">
                                        <i class="fab fa-whatsapp mr-1"></i>Chat
                                    </a>
                                    <form action="{{ route('admin.booking.update-status', 2) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="terbooking">
                                        <button type="submit" onclick="return confirm('Konfirmasi pembayaran telah diterima?')"
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm transition">
                                            <i class="fas fa-check mr-1"></i>Konfirmasi
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Booking Terbooking Example -->
                        @for($i = 1; $i <= 3; $i++)
                        <tr class="hover:bg-gray-50 transition bg-green-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                        <span class="text-purple-600 font-bold">U{{ $i }}</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">User {{ $i }}</p>
                                        <p class="text-sm text-gray-500">user{{ $i }}@email.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $i == 1 ? 'Kost Harmoni' : ($i == 2 ? 'Kost Putri Melati' : 'Kost Putra Wijaya') }}</p>
                                    <p class="text-sm text-gray-600">
                                        <i class="fas fa-door-open text-blue-600 mr-1"></i>Kamar {{ $i + 2 }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600">{{ 24 - $i }} Nov 2025</p>
                                <p class="text-xs text-gray-500">09:00</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-blue-600">Rp {{ number_format($i == 1 ? 1000000 : ($i == 2 ? 1500000 : 1200000), 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-500">/bulan</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>Terbooking
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="https://wa.me/6281234567890" target="_blank"
                                       class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm transition inline-flex items-center">
                                        <i class="fab fa-whatsapp mr-1"></i>Chat
                                    </a>
                                    <button class="bg-gray-300 text-gray-500 px-3 py-1 rounded text-sm cursor-not-allowed" disabled>
                                        <i class="fas fa-check mr-1"></i>Terkonfirmasi
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Info Box -->
        <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg">
            <h3 class="font-semibold text-gray-800 mb-2">
                <i class="fas fa-info-circle text-blue-600 mr-2"></i>Panduan Konfirmasi Booking
            </h3>
            <ul class="text-sm text-gray-700 space-y-2">
                <li class="flex items-start">
                    <i class="fas fa-check text-green-600 mr-2 mt-1"></i>
                    <span>Hubungi penyewa melalui WhatsApp untuk konfirmasi pembayaran</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-green-600 mr-2 mt-1"></i>
                    <span>Pastikan pembayaran telah diterima sebelum mengubah status</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-green-600 mr-2 mt-1"></i>
                    <span>Setelah dikonfirmasi, status kamar otomatis berubah menjadi "Terbooking"</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection