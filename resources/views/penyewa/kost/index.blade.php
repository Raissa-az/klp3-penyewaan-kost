@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-xl font-bold mb-4">Daftar Kost</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($kosts as $kost)
            <a href="{{ route('penyewa.kost.show', $kost->id) }}" class="p-4 border rounded shadow">
                <h3 class="font-semibold">{{ $kost->nama }}</h3>
                <p class="text-sm">{{ $kost->alamat }}</p>
            </a>
        @endforeach
    </div>
</div>
@endsection
