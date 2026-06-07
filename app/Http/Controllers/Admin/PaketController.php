<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PaketWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
    public function index(Request $request) 
    {
        $query = PaketWisata::query();
        
        // Handle pencarian
        if ($request->filled('search')) {
            $query->where('nama_paket', 'like', '%' . $request->search . '%')
                  ->orWhere('destinasi', 'like', '%' . $request->search . '%');
        }
        
        // Handle filter status
        $status = $request->get('status', 'semua');
        if ($status === 'aktif') {
            $query->where('is_active', true);
        } elseif ($status === 'non-aktif') {
            $query->where('is_active', false);
        }

        $pakets = $query->latest()->paginate(10)->withQueryString();
        
        $totalAktif = PaketWisata::where('is_active', true)->count();
        $totalNonAktif = PaketWisata::where('is_active', false)->count();
        $totalSemua = PaketWisata::count();

        return view('admin.pakets.index', compact('pakets', 'status', 'totalAktif', 'totalNonAktif', 'totalSemua'));
    }

    public function create()
    {
        return view('admin.pakets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'destinasi' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'durasi' => 'required|integer|min:1',
            'min_peserta' => 'required|integer|min:1',
            'maks_peserta' => 'nullable|integer|gte:min_peserta',
            'deskripsi' => 'required|string',
            'itinerary' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'nullable|string',
        ]);

        $data = [
            'nama_paket' => $validated['nama_paket'],
            'destinasi' => $validated['destinasi'],
            'harga_per_orang' => $validated['harga'],
            'durasi_hari' => $validated['durasi'],
            'min_peserta' => $validated['min_peserta'],
            'max_peserta' => $validated['maks_peserta'],
            'deskripsi' => $validated['deskripsi'],
            'itinerary' => $validated['itinerary'],
            'is_active' => isset($validated['status']) && $validated['status'] === 'aktif',
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('paket_wisata', 'public');
        }

        PaketWisata::create($data);

        return redirect()->route('admin.pakets.index')->with('success', 'Paket wisata berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $paket = PaketWisata::findOrFail($id);
        return view('admin.pakets.edit', compact('paket'));
    }

    public function update(Request $request, $id)
    {
        $paket = PaketWisata::findOrFail($id);

        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'destinasi' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'durasi' => 'required|integer|min:1',
            'min_peserta' => 'required|integer|min:1',
            'maks_peserta' => 'nullable|integer|gte:min_peserta',
            'deskripsi' => 'required|string',
            'itinerary' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'nullable|string',
        ]);

        $data = [
            'nama_paket' => $validated['nama_paket'],
            'destinasi' => $validated['destinasi'],
            'harga_per_orang' => $validated['harga'],
            'durasi_hari' => $validated['durasi'],
            'min_peserta' => $validated['min_peserta'],
            'max_peserta' => $validated['maks_peserta'],
            'deskripsi' => $validated['deskripsi'],
            'itinerary' => $validated['itinerary'],
            'is_active' => isset($validated['status']) && $validated['status'] === 'aktif',
        ];

        if ($request->hasFile('foto')) {
            if ($paket->foto) {
                Storage::disk('public')->delete($paket->foto);
            }
            $data['foto'] = $request->file('foto')->store('paket_wisata', 'public');
        }

        $paket->update($data);

        return redirect()->route('admin.pakets.index')->with('success', 'Paket wisata berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $paket = PaketWisata::findOrFail($id);
        
        // Ubah is_active jadi false, alih-alih menghapus data permanen
        $paket->update(['is_active' => false]);

        return redirect()->route('admin.pakets.index')->with('success', 'Paket wisata berhasil dinonaktifkan! Histori pesanan tetap aman.');
    }
}