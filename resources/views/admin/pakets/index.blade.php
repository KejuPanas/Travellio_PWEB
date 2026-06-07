@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-['Plus_Jakarta_Sans']">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Kelola Paket Wisata</h1>
            <p class="text-slate-500 mt-1 text-sm">Atur, perbarui, dan tambahkan penawaran perjalanan baru.</p>
        </div>
        <a href="{{ route('admin.pakets.create') }}" class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-2.5 rounded-full text-sm font-bold shadow-md transition-colors flex items-center gap-2">
            <i class="fas fa-plus"></i> Tambah Paket Baru
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        {{-- Toolbar --}}
        <div class="p-4 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex gap-2">
                <a href="{{ route('admin.pakets.index', ['status' => 'semua', 'search' => request('search')]) }}" class="{{ $status === 'semua' ? 'bg-blue-700 text-white' : 'text-slate-600 hover:bg-slate-50' }} px-4 py-1.5 rounded-full text-sm font-bold">Semua Paket ({{ $totalSemua }})</a>
                <a href="{{ route('admin.pakets.index', ['status' => 'aktif', 'search' => request('search')]) }}" class="{{ $status === 'aktif' ? 'bg-blue-700 text-white' : 'text-slate-600 hover:bg-slate-50' }} px-4 py-1.5 rounded-full text-sm font-bold">Aktif ({{ $totalAktif }})</a>
                <a href="{{ route('admin.pakets.index', ['status' => 'non-aktif', 'search' => request('search')]) }}" class="{{ $status === 'non-aktif' ? 'bg-blue-700 text-white' : 'text-slate-600 hover:bg-slate-50' }} px-4 py-1.5 rounded-full text-sm font-bold">Non-aktif ({{ $totalNonAktif }})</a>
            </div>
            
            <form action="{{ route('admin.pakets.index') }}" method="GET" class="relative w-full sm:w-64">
                <input type="hidden" name="status" value="{{ $status }}">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, lokasi..." class="w-full pl-9 pr-4 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-600 outline-none">
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr class="text-slate-500 text-xs uppercase tracking-wider font-bold">
                        <th class="p-4 w-1/2">Info Paket</th>
                        <th class="p-4">Harga / Orang</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse ($pakets as $paket)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-4 flex items-center gap-4">
                            <img src="{{ $paket->foto_url }}" class="w-14 h-14 rounded-lg object-cover {{ !$paket->is_active ? 'grayscale' : '' }}">
                            <div>
                                <p class="font-bold text-slate-900 text-base">{{ $paket->nama_paket }}</p>
                                <p class="text-xs text-slate-500 mt-0.5"><i class="fas fa-map-marker-alt text-slate-400"></i> {{ $paket->destinasi }} ({{ $paket->durasi_hari }} Hari)</p>
                            </div>
                        </td>
                        <td class="p-4">
                            <p class="font-bold text-slate-900 text-base">{{ $paket->harga_format }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">{{ $paket->min_peserta }} - {{ $paket->max_peserta ?? 'Tak terbatas' }} pax</p>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center gap-2">
                                @if($paket->is_active)
                                <div class="w-10 h-5 bg-blue-600 rounded-full relative cursor-default">
                                    <div class="w-4 h-4 bg-white rounded-full absolute right-0.5 top-0.5"></div>
                                </div>
                                <span class="text-blue-600 font-bold text-xs">Aktif</span>
                                @else
                                <div class="w-10 h-5 bg-slate-200 rounded-full relative cursor-default">
                                    <div class="w-4 h-4 bg-white rounded-full absolute left-0.5 top-0.5 shadow-sm"></div>
                                </div>
                                <span class="text-slate-400 font-bold text-xs">Non-aktif</span>
                                @endif
                            </div>
                        </td>
                        <td class="p-4 text-center">
                            <a href="{{ route('admin.pakets.edit', $paket->id) }}" class="text-slate-400 hover:text-blue-600 mx-1 inline-block"><i class="fas fa-edit"></i></a>
                            
                            @if($paket->is_active)
                            <form action="{{ route('admin.pakets.destroy', $paket->id) }}" method="POST" class="inline-block m-0" onsubmit="return confirm('Apakah Anda yakin ingin menonaktifkan paket ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-slate-400 hover:text-red-600 mx-1"><i class="fas fa-trash"></i></button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-slate-500">
                            Tidak ada paket wisata yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        @if($pakets->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $pakets->links() }}
        </div>
        @endif
    </div>
</div>
@endsection