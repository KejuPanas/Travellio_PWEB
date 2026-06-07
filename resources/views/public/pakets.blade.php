@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-['Plus_Jakarta_Sans']">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Paket Wisata</h1>
        <p class="text-slate-500 mt-1">Temukan paket wisata impianmu dari berbagai destinasi indah di seluruh dunia.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Kiri: Filter Sidebar --}}
        <div class="w-full lg:w-1/4">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 sticky top-24">
                <h3 class="font-bold text-slate-900 mb-4 flex items-center gap-2"><i class="fas fa-filter text-blue-600"></i> Filter Paket</h3>
                
                <form action="{{ route('pakets') }}" method="GET" class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Destinasi</label>
                        <select name="destinasi" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-600 bg-white">
                            <option value="">Semua Destinasi</option>
                            @foreach($destinasis as $dest)
                                <option value="{{ $dest }}" {{ request('destinasi') == $dest ? 'selected' : '' }}>{{ $dest }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Harga (Rp)</label>
                        <div class="flex items-center gap-2">
                            <input type="number" name="harga_min" value="{{ request('harga_min') }}" placeholder="Min" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-600">
                            <span class="text-slate-400">-</span>
                            <input type="number" name="harga_max" value="{{ request('harga_max') }}" placeholder="Max" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-600">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Urutkan</label>
                        <select name="sort" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-600 bg-white">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="harga_asc" {{ request('sort') == 'harga_asc' ? 'selected' : '' }}>Termurah</option>
                            <option value="harga_desc" {{ request('sort') == 'harga_desc' ? 'selected' : '' }}>Termahal</option>
                        </select>
                    </div>

                    <div class="pt-2 flex flex-col gap-2">
                        <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-2.5 rounded-lg transition-colors text-sm flex justify-center items-center gap-2">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        <a href="{{ route('pakets') }}" class="w-full text-center text-slate-500 hover:text-slate-700 font-bold py-2 text-sm transition-colors">
                            Reset Filter
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Kanan: Grid Paket List --}}
        <div class="w-full lg:w-3/4">
            <div class="mb-4 text-sm text-slate-500">
                Menampilkan <span class="font-bold text-slate-900">{{ $pakets->total() }} paket</span> wisata
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                @forelse ($pakets as $paket)
                {{-- Card Paket --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden group hover:shadow-md transition-shadow flex flex-col justify-between">
                    <div>
                        <div class="relative h-56 overflow-hidden">
                            {{-- Cek apakah pakai foto upload atau foto default --}}
                            <img src="{{ $paket->foto ? asset('storage/'.$paket->foto) : 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=600&q=80' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-1.5 text-xs font-bold text-slate-500 mb-2 uppercase tracking-wide">
                                <i class="fas fa-map-marker-alt text-blue-600"></i> {{ $paket->destinasi }}
                            </div>
                            <h3 class="font-extrabold text-slate-900 text-xl mb-3 line-clamp-1">{{ $paket->nama_paket }}</h3>
                            
                            <div class="flex items-center gap-4 text-sm text-slate-600 mb-5 bg-slate-50 p-3 rounded-xl border border-slate-100">
                                <span class="flex items-center gap-2"><i class="far fa-clock text-slate-400"></i> {{ $paket->durasi_hari }} Hari</span>
                                <span class="text-slate-300">|</span>
                                <span class="flex items-center gap-2"><i class="fas fa-user-friends text-slate-400"></i> Min {{ $paket->min_peserta }} Pax</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-5 pt-0 mt-auto">
                        <div class="flex justify-between items-end border-t border-slate-100 pt-5">
                            <div>
                                <p class="text-xs text-slate-400 font-medium mb-0.5">Harga per pax</p>
                                <p class="font-black text-blue-700 text-xl">{{ $paket->harga_format }}</p>
                            </div>
                            
                            <a href="{{ route('paket.show', $paket->id) }}" class="bg-blue-50 border border-blue-100 text-blue-700 hover:bg-blue-600 hover:text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-sm">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-slate-50 p-8 rounded-2xl border border-slate-100 text-center">
                    <i class="fas fa-box-open text-4xl text-slate-300 mb-3"></i>
                    <h3 class="text-lg font-bold text-slate-800">Paket Tidak Ditemukan</h3>
                    <p class="text-sm text-slate-500 mt-1">Coba ubah filter pencarian kamu.</p>
                </div>
                @endforelse

            </div>

            {{-- Link Pagination Bawaan Laravel --}}
            <div class="mt-8">
                {{ $pakets->links() }}
            </div>

        </div>
    </div>
</div>
@endsection