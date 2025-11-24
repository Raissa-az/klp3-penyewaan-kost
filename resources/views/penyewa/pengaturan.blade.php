@extends('layouts.app')

@section('title', 'Pengaturan - KostKu')

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Pengaturan Akun</h1>
            <p class="text-gray-600 mt-2">Kelola informasi profil dan keamanan akun Anda</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Sidebar Menu -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-4 bg-gradient-to-r from-blue-600 to-purple-600">
                        <div class="flex items-center space-x-3">
                            <div class="h-16 w-16 rounded-full bg-white flex items-center justify-center">
                                <span class="text-2xl font-bold text-blue-600">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                            </div>
                            <div class="text-white">
                                <p class="font-semibold">{{ auth()->user()->name }}</p>
                                <p class="text-sm text-blue-100">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    <nav class="p-2" x-data="{ active: 'profil' }">
                        <button @click="active = 'profil'" 
                                :class="active === 'profil' ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-600' : 'text-gray-600 hover:bg-gray-50'"
                                class="w-full text-left px-4 py-3 rounded transition flex items-center">
                            <i class="fas fa-user mr-3"></i>
                            <span class="font-medium">Profil Saya</span>
                        </button>
                        <button @click="active = 'password'" 
                                :class="active === 'password' ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-600' : 'text-gray-600 hover:bg-gray-50'"
                                class="w-full text-left px-4 py-3 rounded transition flex items-center mt-1">
                            <i class="fas fa-lock mr-3"></i>
                            <span class="font-medium">Ubah Password</span>
                        </button>
                    </nav>
                </div>
            </div>
            
            <!-- Content Area -->
            <div class="lg:col-span-2" x-data="{ active: 'profil' }">
                <!-- Profil Form -->
                <div x-show="active === 'profil'" x-cloak class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">
                        <i class="fas fa-user-edit text-blue-600 mr-2"></i>Edit Profil
                    </h2>
                    
                    <form action="{{ route('penyewa.update-profil') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user text-blue-600 mr-2"></i>Nama Lengkap
                            </label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="Masukkan nama lengkap">
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-envelope text-blue-600 mr-2"></i>Email
                            </label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="email@example.com">
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-phone text-blue-600 mr-2"></i>No. Telepon
                            </label>
                            <input type="tel" name="phone" value="{{ auth()->user()->phone ?? '' }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="08123456789">
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt text-blue-600 mr-2"></i>Alamat
                            </label>
                            <textarea name="address" rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                      placeholder="Masukkan alamat lengkap">{{ auth()->user()->address ?? '' }}</textarea>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition">
                                <i class="fas fa-save mr-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Password Form -->
                <div x-show="active === 'password'" x-cloak class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">
                        <i class="fas fa-key text-blue-600 mr-2"></i>Ubah Password
                    </h2>
                    
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                        <p class="text-sm text-gray-700">
                            <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                            Pastikan password baru memiliki minimal 8 karakter untuk keamanan akun Anda.
                        </p>
                    </div>
                    
                    <form action="{{ route('penyewa.update-password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-lock text-blue-600 mr-2"></i>Password Lama
                            </label>
                            <input type="password" name="current_password" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="Masukkan password lama">
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-lock text-blue-600 mr-2"></i>Password Baru
                            </label>
                            <input type="password" name="new_password" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="Minimal 8 karakter">
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-lock text-blue-600 mr-2"></i>Konfirmasi Password Baru
                            </label>
                            <input type="password" name="new_password_confirmation" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="Ulangi password baru">
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition">
                                <i class="fas fa-key mr-2"></i>Ubah Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection