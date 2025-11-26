@extends('layouts.app')

@section('title', 'Kelola Booking - Admin KostKu')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Kelola Booking</h1>
            <p class="text-gray-600 mt-1">Konfirmasi pembayaran booking dari penyewa</p>
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

        <!-- Tabel Booking -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Penyewa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kost</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kamar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Update Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-semibold text-gray-900">{{ $booking->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $booking->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $booking->kamar->kost->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-900">
                                Kamar {{ $booking->kamar->nomor }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
         @if($booking->status === 'pending')
    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">
        <i class="fas fa-clock mr-1"></i> Pending
    </span>
@elseif($booking->status === 'aktif')
    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
        <i class="fas fa-check mr-1"></i> Aktif
    </span>
@else
    <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
        <i class="fas fa-flag-checkered mr-1"></i> Selesai
    </span>
@endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('admin.booking.updateStatus', $booking->id) }}" method="POST">
    @csrf
    <select name="status" onchange="this.form.submit()" 
            class="text-sm border-gray-300 rounded-lg focus:ring-indigo-500">
        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="aktif" {{ $booking->status == 'aktif' ? 'selected' : '' }}>Aktif (Disetujui)</option>
        <option value="selesai" {{ $booking->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
    </select>
</form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $booking->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <form action="{{ route('admin.booking.destroy', $booking->id) }}" 
                                      method="POST"
                                      onsubmit="return confirm('Hapus booking ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
                                <p class="text-gray-500 text-lg">Belum ada booking</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
@endsection