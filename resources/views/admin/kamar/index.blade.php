@extends('layouts.app')

@section('title', 'Kelola Kamar - Admin KostKu')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Kelola Kamar</h1>
                <p class="text-gray-600 mt-1">Tambah, edit, dan hapus data kamar kost</p>
            </div>
            <a href="{{ route('admin.kamar.create') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold shadow-md">
                <i class="fas fa-plus mr-2"></i> Tambah Kamar
            </a>
        </div>
        
        <!-- Filter by Kost Type -->
        <div class="bg-white rounded-xl shadow-md p-4 mb-6 flex items-center space-x-3">
            <span class="text-gray-700 font-medium">Filter:</span>
            <a href="?tipe=all" class="px-4 py-2 rounded-lg font-medium transition
                {{ request('tipe', 'all') === 'all' ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Semua
            </a>
            <a href="?tipe=Khusus Cewe" class="px-4 py-2 rounded-lg font-medium transition
                {{ request('tipe') === 'Khusus Cewe' ? 'bg-pink-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Khusus Cewe
            </a>
            <a href="?tipe=Khusus Cowo" class="px-4 py-2 rounded-lg font-medium transition
                {{ request('tipe') === 'Khusus Cowo' ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Khusus Cowo
            </a>
            <a href="?tipe=Campuran" class="px-4 py-2 rounded-lg font-medium transition
                {{ request('tipe') === 'Campuran' ? 'bg-purple-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Campuran
            </a>
        </div>
        
        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-xl mr-3"></i>
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
        </div>
        @endif
        
        <!-- Kamar List by Kost -->
        @if(isset($kostList) && count($kostList) > 0)
            @foreach($kostList as $kost)
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <!-- Kost Header -->
                <div class="bg-gradient-to-r 
                    {{ $kost->tipe === 'Khusus Cewe' ? 'from-pink-500 to-pink-600' : '' }}
                    {{ $kost->tipe === 'Khusus Cowo' ? 'from-blue-500 to-blue-600' : '' }}
                    {{ $kost->tipe === 'Campuran' ? 'from-purple-500 to-purple-600' : '' }}
                    text-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold">{{ $kost->nama }}</h2>
                            <p class="text-white text-opacity-90 mt-1">
                                <i class="fas fa-map-marker-alt mr-2"></i> {{ $kost->lokasi }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-3xl font-bold">{{ $kost->kamar->count() }}</p>
                            <p class="text-white text-opacity-90">Kamar</p>
                        </div>
                    </div>
                </div>
                
                <!-- Kamar Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nomor Kamar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipe</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Update Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($kost->kamar as $kamar)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-bed text-indigo-600"></i>
                                        </div>
                                        <span class="font-semibold text-gray-900">Kamar {{ $kamar->nomor }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $kamar->tipe_kamar }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-semibold text-indigo-600">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</span>
                                    <span class="text-xs text-gray-500">/bulan</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($kamar->status === 'tersedia')
                                        <span class="px-3 py-1 badge-tersedia rounded-full text-xs font-semibold">
                                            <i class="fas fa-check mr-1"></i> Tersedia
                                        </span>
                                    @else
                                        <span class="px-3 py-1 badge-terbooking rounded-full text-xs font-semibold">
                                            <i class="fas fa-times mr-1"></i> Terbooking
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.kamar.update-status', $kamar->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()" class="text-sm border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                            <option value="tersedia" {{ $kamar->status === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                            <option value="terbooking" {{ $kamar->status === 'terbooking' ? 'selected' : '' }}>Terbooking</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.kamar.edit', $kamar->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.kamar.destroy', $kamar->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kamar ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-md p-16 text-center">
                <i class="fas fa-bed text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">Belum Ada Kamar</h3>
                <p class="text-gray-500 mb-6">Mulai tambahkan kamar kost untuk sistem Anda</p>
                <a href="{{ route('admin.kamar.create') }}" class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
                    <i class="fas fa-plus mr-2"></i> Tambah Kamar Pertama
                </a>
            </div>
        @endif
        
    </div>
</div>
@endsection