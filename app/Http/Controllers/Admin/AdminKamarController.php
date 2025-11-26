<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Kost;
use Illuminate\Http\Request;

class AdminKamarController extends Controller
{

    public function index(Request $request)
{
    // Filter berdasarkan tipe kost
    $tipe = $request->get('tipe', 'all');
    
    $query = Kost::with(['kamars' => function($q) {
        $q->orderBy('nomor');
    }]);
    
    if ($tipe !== 'all') {
        $query->where('tipe', $tipe);
    }
    
    $kostList = $query->get();
    
    return view('admin.kamar.index', compact('kostList'));
}

    public function create()
    {
        $kosts = Kost::all();
        return view('admin.kamar.create', compact('kosts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kost_id'    => 'required|exists:kosts,id',
            'nomor'      => 'required',
            'tipe_kamar' => 'required',
            'harga'      => 'required|numeric',
            'status'     => 'required|in:tersedia,terbooking,disewa',
            'deskripsi'  => 'nullable'
        ]);

        Kamar::create($request->all());

        return redirect()->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        $kosts = Kost::all();
        return view('admin.kamar.edit', compact('kamar', 'kosts'));
    }

    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);

        $request->validate([
            'kost_id'    => 'required|exists:kosts,id',
            'nomor'      => 'required',
            'tipe_kamar' => 'required',
            'harga'      => 'required|numeric',
            'status'     => 'required|in:tersedia,terbooking,disewa',
            'deskripsi'  => 'nullable'
        ]);

        $kamar->update($request->all());

        return redirect()->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->delete();

        return redirect()->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil dihapus.');
    }
    public function updateStatus(Request $request, $id)
{
    $kamar = Kamar::findOrFail($id);
    
    $request->validate([
        'status' => 'required|in:tersedia,terbooking,disewa'
    ]);
    
    $kamar->update(['status' => $request->status]);
    
    return redirect()->back()->with('success', 'Status kamar berhasil diperbarui.');
}
}

