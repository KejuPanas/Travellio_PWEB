<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $pakets = PaketWisata::active()->latest()->take(6)->get();
        return view('public.landing', compact('pakets'));
    }

    public function pakets(Request $request)
    {
        $query = PaketWisata::active();

        if ($request->filled('destinasi')) {
            $query->byDestinasi($request->destinasi);
        }

        if ($request->filled('harga_min') || $request->filled('harga_max')) {
            $query->byHarga($request->harga_min, $request->harga_max);
        }

        if ($request->filled('sort')) {
            match($request->sort) {
                'harga_asc'  => $query->orderBy('harga_per_orang', 'asc'),
                'harga_desc' => $query->orderBy('harga_per_orang', 'desc'),
                'terbaru'    => $query->latest(),
                default      => $query->latest(),
            };
        } else {
            $query->latest();
        }

        $pakets = $query->paginate(9)->withQueryString();

        $destinasis = PaketWisata::active()
            ->select('destinasi')
            ->distinct()
            ->pluck('destinasi');

        return view('public.pakets', compact('pakets', 'destinasis'));
    }

    public function showPaket(PaketWisata $paketWisata)
    {
        if (!$paketWisata->is_active) {
            abort(404);
        }

        $related = PaketWisata::active()
            ->where('id', '!=', $paketWisata->id)
            ->where('destinasi', 'like', '%' . explode(',', $paketWisata->destinasi)[0] . '%')
            ->take(3)
            ->get();

        return view('public.detail-paket', compact('paketWisata', 'related'));
    }
}