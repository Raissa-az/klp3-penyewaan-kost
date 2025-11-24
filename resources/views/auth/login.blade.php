@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-10">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">

        <h2 class="text-2xl font-bold text-center mb-6">Login Penyewaan Kost</h2>

        {{-- Pesan Error --}}
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-3">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-3">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validasi --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-3">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- PERHATIAN: POST ke route 'login.process' --}}
        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label class="block font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200"
                    placeholder="Masukkan email" required>
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label class="block font-medium">Password</label>
                <input type="password" name="password"
                    class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200"
                    placeholder="Masukkan password" required>
            </div>

            {{-- Tombol Login --}}
            <button type="submit"
                class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                Login
            </button>
        </form>

        {{-- Link ke Register --}}
        <p class="text-center mt-4 text-sm text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">
                Daftar Sekarang
            </a>
        </p>
    </div>
</div>
@endsection
