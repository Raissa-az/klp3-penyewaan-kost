@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Kamar</h3>

    @foreach ($kamars as $kamar)
        <div class="card mt-2">
            <div class="card-body">
                <h5>{{ $kamar->nama }}</h5>
                <p>Kost: {{ $kamar->kost->nama }}</p>
                <p>Harga: Rp {{ number_format($kamar->harga, 0, ',', '.') }}</p>
                <p>Status: {{ $kamar->status }}</p>

                @if($kamar->status == 'tersedia')
                <form action="{{ route('penyewa.booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="kamar_id" value="{{ $kamar->id }}">
                    <button class="btn btn-success">Booking</button>
                </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
