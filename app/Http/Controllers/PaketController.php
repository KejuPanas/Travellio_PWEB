<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaketWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = PaketWisata::latest()->paginate(10);
        return view('admin.paket.index', compact('pakets'));
    }

    public function create()
    {
        return view('admin.paket.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket'     => 'required|string|max:255',
            'deskripsi'      => 'required|string',
            'itinerary'      => 'required|string',
            'harga_per_orang' => 'required|numeric|min:0',
            'destinasi'      => 'required|string|max:255',
            'durasi_hari'    => 'required|integer|min:1',
            'min_peserta'    => 'required|integer|min:1',
            'max_peserta'    => 'nullable|integer|min:1',
            'foto'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active'      => 'boolean',
        ], [
            'nama_paket.required'      => 'Nama paket wajib diisi.',
            'harga_per_orang.required' => 'Harga wajib diisi.',
            'foto.image'               => 'File harus berupa gambar.',
            'foto.max'                 => 'Ukuran foto maksimal 2MB.',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pakets', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        PaketWisata::create($validated);

        return redirect()->route('admin.pakets.index')
            ->with('success', 'Paket wisata berhasil ditambahkan.');
    }

    public function edit(PaketWisata $paket)
    {
        return view('admin.paket.edit', compact('paket'));
    }

    public function update(Request $request, PaketWisata $paket)
    {
        $validated = $request->validate([
            'nama_paket'     => 'required|string|max:255',
            'deskripsi'      => 'required|string',
            'itinerary'      => 'required|string',
            'harga_per_orang' => 'required|numeric|min:0',
            'destinasi'      => 'required|string|max:255',
            'durasi_hari'    => 'required|integer|min:1',
            'min_peserta'    => 'required|integer|min:1',
            'max_peserta'    => 'nullable|integer|min:1',
            'foto'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active'      => 'boolean',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($paket->foto) {
                Storage::disk('public')->delete($paket->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pakets', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $paket->update($validated);

        return redirect()->route('admin.pakets.index')
            ->with('success', 'Paket wisata berhasil diupdate.');
    }

    public function destroy(PaketWisata $paket)
    {
        if ($paket->bookings()->whereIn('status', ['Pending', 'Dikonfirmasi', 'Berlangsung'])->exists()) {
            return back()->with('error', 'Paket tidak bisa dihapus karena masih ada booking aktif.');
        }

        if ($paket->foto) {
            Storage::disk('public')->delete($paket->foto);
        }

        $paket->delete();

        return redirect()->route('admin.pakets.index')
            ->with('success', 'Paket wisata berhasil dihapus.');
    }
}