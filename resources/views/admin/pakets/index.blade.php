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
                <button class="bg-blue-700 text-white px-4 py-1.5 rounded-full text-sm font-bold">Semua Paket (24)</button>
                <button class="text-slate-600 hover:bg-slate-50 px-4 py-1.5 rounded-full text-sm font-bold">Aktif (18)</button>
                <button class="text-slate-600 hover:bg-slate-50 px-4 py-1.5 rounded-full text-sm font-bold">Non-aktif (6)</button>
            </div>
            <div class="relative w-full sm:w-64">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" placeholder="Cari nama, lokasi..." class="w-full pl-9 pr-4 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-600 outline-none">
            </div>
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
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-4 flex items-center gap-4">
                            <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=100&q=80" class="w-14 h-14 rounded-lg object-cover">
                            <div>
                                <p class="font-bold text-slate-900 text-base">Eksplorasi Bali Tropis 4H3M</p>
                                <p class="text-xs text-slate-500 mt-0.5"><i class="fas fa-map-marker-alt text-slate-400"></i> Bali, Indonesia</p>
                            </div>
                        </td>
                        <td class="p-4">
                            <p class="font-bold text-slate-900 text-base">Rp 4.500.000</p>
                            <p class="text-xs text-slate-500 mt-0.5">Diskon 10% aktif</p>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-5 bg-blue-600 rounded-full relative cursor-pointer">
                                    <div class="w-4 h-4 bg-white rounded-full absolute right-0.5 top-0.5"></div>
                                </div>
                                <span class="text-blue-600 font-bold text-xs">Aktif</span>
                            </div>
                        </td>
                        <td class="p-4 text-center">
                            <a href="{{ route('admin.pakets.edit', 1) }}" class="text-slate-400 hover:text-blue-600 mx-1 inline-block"><i class="fas fa-edit"></i></a>
                            <button class="text-slate-400 hover:text-red-600 mx-1"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-4 flex items-center gap-4">
                            <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&w=100&q=80" class="w-14 h-14 rounded-lg object-cover grayscale">
                            <div>
                                <p class="font-bold text-slate-900 text-base">City Tour Tokyo 5H4M</p>
                                <p class="text-xs text-slate-500 mt-0.5"><i class="fas fa-map-marker-alt text-slate-400"></i> Tokyo, Japan</p>
                            </div>
                        </td>
                        <td class="p-4">
                            <p class="font-bold text-slate-900 text-base">Rp 12.500.000</p>
                            <p class="text-xs text-slate-500 mt-0.5">Habis Terjual</p>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-5 bg-slate-200 rounded-full relative cursor-pointer">
                                    <div class="w-4 h-4 bg-white rounded-full absolute left-0.5 top-0.5 shadow-sm"></div>
                                </div>
                                <span class="text-slate-400 font-bold text-xs">Non-aktif</span>
                            </div>
                        </td>
                        <td class="p-4 text-center">
                            <a href="{{ route('admin.pakets.edit', 1) }}" class="text-slate-400 hover:text-blue-600 mx-1 inline-block"><i class="fas fa-edit"></i></a>
                            <button class="text-slate-400 hover:text-red-600 mx-1"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        {{-- Pagination Placeholder --}}
        <div class="p-4 border-t border-slate-100 flex justify-between items-center text-sm text-slate-500">
            <span>Menampilkan 1-3 dari 24 paket</span>
            <div class="flex gap-1">
                <button class="px-3 py-1 border border-slate-200 rounded hover:bg-slate-50">&lt;</button>
                <button class="px-3 py-1 bg-blue-700 text-white rounded">1</button>
                <button class="px-3 py-1 border border-slate-200 rounded hover:bg-slate-50">2</button>
                <button class="px-3 py-1 border border-slate-200 rounded hover:bg-slate-50">&gt;</button>
            </div>
        </div>
    </div>
</div>
@endsection