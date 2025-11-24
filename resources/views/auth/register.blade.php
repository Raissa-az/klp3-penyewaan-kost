@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-10">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">

        <h2 class="text-2xl font-bold text-center mb-6">Daftar Penyewa Kost</h2>

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

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-medium">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Password</label>
                <input type="password" name="password"
                       class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                       class="w-full border p-2 rounded" required>
            </div>

            <button type="submit"
                class="w-full bg-green-600 text-white p-2 rounded hover:bg-green-700">
                Daftar
            </button>

        </form>

        <p class="text-center mt-4 text-sm text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
                Login
            </a>
        </p>

    </div>
</div>
@endsection
