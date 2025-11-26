@extends('layouts.app')

@section('title', 'Tambah Kamar - Admin KostKu')

@section('content')
<div class="py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600">Dashboard</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <a href="{{ route('admin.kamar.index') }}" class="hover:text-indigo-600">Kelola Kamar</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-gray-900 font-medium">Tambah Kamar</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Tambah Kamar Baru</h1>
            <p class="text-gray-600 mt-1">Lengkapi form di bawah untuk menambahkan kamar</p>
        </div>
        
        <!-- Form -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <form action="{{ route('admin.kamar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Pilih Kost -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-home text-indigo-600 mr-1"></i> Pilih Kost
                    </label>
                    <select name="kost_id" required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('kost_id') border-red-500 @enderror">
                        <option value="">-- Pilih Kost --</option>
                        @foreach($kosts as $kost)

                            <option value="{{ $kost->id }}" {{ old('kost_id') == $kost->id ? 'selected' : '' }}>
                                {{ $kost->nama }} ({{ ucfirst($kost->tipe) }})
                            </option>
                        @endforeach
                    </select>
                    @error('kost_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Nomor Kamar -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-door-closed text-indigo-600 mr-1"></i> Nomor Kamar
                    </label>
                    <input type="text" name="nomor" value="{{ old('nomor') }}"
                        placeholder="Contoh: 101, A1, B2"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('nomor') border-red-500 @enderror">
                    @error('nomor')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Nomor unik untuk setiap kamar dalam satu kost</p>
                </div>
                
                <!-- Tipe Kamar -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-bed text-indigo-600 mr-1"></i> Tipe Kamar
                    </label>
                    <select name="tipe_kamar" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('tipe_kamar') border-red-500 @enderror">
                        <option value="">-- Pilih Tipe --</option>
                        <option value="KM Dalam" {{ old('tipe_kamar') == 'KM Dalam' ? 'selected' : '' }}>Kamar Mandi Dalam</option>
                        <option value="KM Sharing" {{ old('tipe_kamar') == 'KM Sharing' ? 'selected' : '' }}>Kamar Mandi Sharing</option>
                    </select>
                    @error('tipe_kamar')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Harga -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-money-bill-wave text-indigo-600 mr-1"></i> Harga per Bulan
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                        <input type="number" name="harga" value="{{ old('harga') }}"
                            placeholder="0"
                            required min="0"
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('harga') border-red-500 @enderror">
                    </div>
                    @error('harga')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Contoh: 1200000 untuk Rp 1.200.000</p>
                </div>
                
                <!-- Status Kamar -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-toggle-on text-indigo-600 mr-1"></i> Status Kamar
                    </label>
                    <div class="flex items-center space-x-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="status" value="tersedia"
                                {{ old('status', 'tersedia') == 'tersedia' ? 'checked' : '' }}
                                class="w-4 h-4 text-indigo-600">
                            <span class="ml-2 text-gray-700">Tersedia</span>
                        </label>

                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="status" value="terbooking"
                                {{ old('status') == 'terbooking' ? 'checked' : '' }}
                                class="w-4 h-4 text-indigo-600">
                            <span class="ml-2 text-gray-700">Terbooking</span>
                        </label>

                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="status" value="disewa"
                                {{ old('status') == 'disewa' ? 'checked' : '' }}
                                class="w-4 h-4 text-indigo-600">
                            <span class="ml-2 text-gray-700">Disewa</span>
                        </label>
                    </div>

                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-indigo-600 mr-1"></i> Deskripsi (Opsional)
                    </label>
                    <textarea name="deskripsi" rows="4"
                        placeholder="Tambahkan catatan atau informasi tambahan..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Buttons -->
                <div class="flex items-center justify-between pt-6 border-t">
                    <a href="{{ route('admin.kamar.index') }}" 
                        class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold shadow-md">
                        <i class="fas fa-save mr-2"></i> Simpan Kamar
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Info Box -->
        <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
            <div class="flex">
                <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                <div class="text-sm text-blue-800">
                    <p class="font-semibold mb-1">Tips:</p>
                    <ul class="list-disc list-inside space-y-1">
                        <li>Nomor kamar harus unik untuk setiap kost</li>
                        <li>Harga diisi tanpa titik/koma</li>
                        <li>Status bisa diubah sewaktu-waktu dari halaman kelola kamar</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
