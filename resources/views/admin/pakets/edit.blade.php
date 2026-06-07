@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-['Plus_Jakarta_Sans']">
    
    {{-- Back Link & Header --}}
    <a href="{{ route('admin.pakets.index') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 flex items-center gap-2 mb-4 w-max transition-colors">
        <i class="fas fa-arrow-left"></i> Kembali ke Kelola Paket
    </a>
    <div>
        <h1 class="text-3xl font-bold text-slate-900">Edit Paket Wisata</h1>
        <p class="text-slate-500 mt-1 text-sm">{{ $paket->nama_paket }}</p>
    </div>

    {{-- Form Utama --}}
    <form action="{{ route('admin.pakets.update', $paket->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 mt-8">
        @csrf
        @method('PUT')

        {{-- Section 1: Informasi Dasar --}}
        <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-slate-100">
            <h2 class="text-lg font-bold text-slate-800 mb-6">Informasi dasar</h2>
            
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama paket <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_paket" required value="{{ old('nama_paket', $paket->nama_paket) }}" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition-colors text-sm">
                    @error('nama_paket') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Destinasi <span class="text-red-500">*</span></label>
                        <input type="text" name="destinasi" required value="{{ old('destinasi', $paket->destinasi) }}" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition-colors text-sm">
                        @error('destinasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Harga per orang (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="harga" required value="{{ old('harga', intval($paket->harga_per_orang)) }}" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition-colors text-sm">
                        @error('harga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Durasi (hari) <span class="text-red-500">*</span></label>
                        <input type="number" name="durasi" required value="{{ old('durasi', $paket->durasi_hari) }}" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition-colors text-sm">
                        @error('durasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Min. peserta <span class="text-red-500">*</span></label>
                        <input type="number" name="min_peserta" required value="{{ old('min_peserta', $paket->min_peserta) }}" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition-colors text-sm">
                        @error('min_peserta') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Maks. peserta</label>
                        <input type="number" name="maks_peserta" value="{{ old('maks_peserta', $paket->max_peserta) }}" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition-colors text-sm">
                        @error('maks_peserta') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 2: Konten --}}
        <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-slate-100">
            <h2 class="text-lg font-bold text-slate-800 mb-6">Konten</h2>
            
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" required rows="3" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition-colors text-sm">{{ old('deskripsi', $paket->deskripsi) }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Itinerary <span class="text-red-500">*</span></label>
                    <textarea name="itinerary" required rows="5" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition-colors text-sm">{{ old('itinerary', $paket->itinerary) }}</textarea>
                    @error('itinerary') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Section 3: Foto & Status --}}
        <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-slate-100">
            <h2 class="text-lg font-bold text-slate-800 mb-6">Foto & status</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Tampilan Foto Lama & Upload Baru --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Foto destinasi saat ini</label>
                    <div class="flex items-center gap-4 mb-3">
                        <img src="{{ $paket->foto_url }}" class="w-20 h-20 rounded-lg object-cover border border-slate-200">
                        <p class="text-xs text-slate-500">Abaikan jika tidak ingin mengubah foto.</p>
                    </div>
                    <label class="border-2 border-dashed border-slate-300 rounded-xl bg-slate-50 p-6 flex flex-col items-center justify-center text-center hover:bg-slate-100 transition-colors cursor-pointer w-full">
                        <i class="fas fa-upload text-xl text-slate-400 mb-2"></i>
                        <p class="text-xs font-bold text-slate-700">Ganti foto baru (Opsional)</p>
                        <input type="file" name="foto" class="hidden" accept="image/jpeg, image/png, image/webp">
                    </label>
                    @error('foto') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Status Toggle --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Status paket</label>
                    <div class="flex items-start gap-3 mt-2">
                        <label class="relative inline-flex items-center cursor-pointer flex-shrink-0">
                            <input type="checkbox" name="status" value="aktif" class="sr-only peer" {{ old('status', $paket->is_active ? 'aktif' : '') == 'aktif' ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                        <div>
                            <p class="text-sm font-bold text-slate-900">Paket aktif — ditampilkan di website</p>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">Nonaktifkan untuk menyembunyikan paket ini dari halaman pelanggan tanpa menghapus datanya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Buttons --}}
        <div class="flex justify-end items-center gap-3 pt-2">
            <a href="{{ route('admin.pakets.index') }}" class="px-6 py-2.5 border border-slate-300 text-slate-700 font-bold rounded-lg hover:bg-slate-50 transition-colors text-sm">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-blue-700 hover:bg-blue-800 text-white font-bold rounded-lg shadow-md transition-colors text-sm flex items-center gap-2">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection