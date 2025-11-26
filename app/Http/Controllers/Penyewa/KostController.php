<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use Illuminate\Http\Request;

class KostController extends Controller
{
    // Halaman daftar semua kost (untuk cari kost)
    public function index(Request $request)
{
    $query = Kost::with(['kamars' => function($q) {
        $q->orderBy('nomor');
    }]);

    // Filter berdasarkan tipe jika ada
    if ($request->has('tipe') && $request->tipe) {
        $query->where('tipe', $request->tipe);
    }

    // Filter harga min
    if ($request->has('harga_min') && $request->harga_min) {
        $query->where('harga', '>=', $request->harga_min);
    }

    // Filter harga max
    if ($request->has('harga_max') && $request->harga_max) {
        $query->where('harga', '<=', $request->harga_max);
    }

    $kostList = $query->get();

    return view('penyewa.cari-kost', compact('kostList'));
}

    // Halaman kost berdasarkan tipe (cewe/cowo/campur)
    public function showByType($tipe)
    {
        // Validasi tipe
        if (!in_array($tipe, ['cewe', 'cowo', 'campur'])) {
            abort(404);
        }

        // Ambil SEMUA kost dengan tipe tertentu beserta kamarnya
        $kosts = Kost::with(['kamars' => function($query) {
            $query->orderBy('nomor');
        }])
        ->where('tipe', $tipe)
        ->get();

        return view('penyewa.kost.tipe', compact('kosts', 'tipe'));


    }

    // Detail 1 kost dengan semua kamarnya
    public function showDetail($id)
    {
        $kost = Kost::with(['kamars' => function($query) {
            $query->orderBy('nomor');
        }])->findOrFail($id);

        return view('penyewa.kost.detail', compact('kost'));
    }

    // Show kost (untuk detail kost populer dari dashboard)
    public function show($id)
    {
        $kost = Kost::with('kamars')->findOrFail($id);
        return view('penyewa.kost.show', compact('kost'));
    }
}