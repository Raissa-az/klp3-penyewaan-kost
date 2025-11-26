@extends('admin.layouts.main')

@section('content')
<div class="container mx-auto px-6 py-6">

    <h2 class="text-2xl font-bold mb-4 text-indigo-700">Edit Kamar</h2>

    <div class="bg-white shadow-lg rounded-xl p-6">

        <form action="{{ route('admin.kamar.update', $kamar->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Pilih Kost -->
            <div class="mb-5">
                <label class="block font-semibold mb-1">Pilih Kost</label>
                <select name="kost_id"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-300">
                    @foreach ($kosts as $kost)
                        <option value="{{ $kost->id }}" 
                            {{ $kamar->kost_id == $kost->id ? 'selected' : '' }}>
                            {{ $kost->nama }} ({{ ucfirst($kost->tipe) }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Kamar -->
            <div class="mb-5">
                <label class="block font-semibold mb-1">Nama Kamar</label>
                <input type="text" name="nama"
                    value="{{ $kamar->nama }}"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-300"
                    required>
            </div>

            <!-- Harga -->
            <div class="mb-5">
                <label class="block font-semibold mb-1">Harga / Bulan (Rp)</label>
                <input type="number" name="harga"
                    value="{{ $kamar->harga }}"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-300"
                    required>
            </div>

            <!-- Status -->
            <div class="mb-5">
                <label class="block font-semibold mb-1">Status</label>
                <select name="status"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-300" required>
                    <option value="tersedia" {{ $kamar->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="menunggu" {{ $kamar->status == 'menunggu' ? 'selected' : '' }}>Terbooking</option>
                    <option value="disewa" {{ $kamar->status == 'disewa' ? 'selected' : '' }}>Disewa</option>
                </select>
            </div>

            <!-- Deskripsi -->
            <div class="mb-5">
                <label class="block font-semibold mb-1">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" rows="4"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-300">{{ $kamar->deskripsi }}</textarea>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.kamar.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Kembali
                </a>

                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Update Kamar
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
