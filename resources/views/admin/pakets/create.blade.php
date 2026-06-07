@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-['Plus_Jakarta_Sans']">
    
    {{-- Back Link & Header --}}
    <a href="{{ route('admin.pakets.index') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 flex items-center gap-2 mb-4 w-max transition-colors">
        <i class="fas fa-arrow-left"></i> Kembali ke Kelola Paket
    </a>
    <h1 class="text-3xl font-bold text-slate-900 mb-8">Tambah Paket Wisata Baru</h1>

    {{-- Form Utama --}}
    <form action="{{ route('admin.pakets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Section 1: Informasi Dasar --}}
        <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-slate-100">
            <h2 class="text-lg font-bold text-slate-800 mb-6">Informasi dasar</h2>
            
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama paket <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_paket" value="{{ old('nama_paket') }}" required placeholder="Contoh: Paket Bali 3D2N All Inclusive" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition-colors text-sm">
                    @error('nama_paket') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Destinasi <span class="text-red-500">*</span></label>
                        <input type="text" name="destinasi" value="{{ old('destinasi') }}" required placeholder="Contoh: Bali" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition-colors text-sm">
                        @error('destinasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Harga per orang (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="harga" value="{{ old('harga') }}" required placeholder="0" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition-colors text-sm">
                        @error('harga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Durasi (hari) <span class="text-red-500">*</span></label>
                        <input type="number" name="durasi" value="{{ old('durasi', 3) }}" required class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition-colors text-sm">
                        @error('durasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Min. peserta <span class="text-red-500">*</span></label>
                        <input type="number" name="min_peserta" value="{{ old('min_peserta', 2) }}" required class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition-colors text-sm">
                        @error('min_peserta') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Maks. peserta</label>
                        <input type="number" name="maks_peserta" value="{{ old('maks_peserta', 20) }}" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition-colors text-sm">
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
                    <textarea name="deskripsi" required rows="3" placeholder="Tuliskan deskripsi singkat namun menarik tentang paket wisata ini..." class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition-colors text-sm">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Itinerary <span class="text-red-500">*</span></label>
                    <textarea name="itinerary" required rows="5" placeholder="Hari 1: ...&#10;Hari 2: ...&#10;Hari 3: ..." class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none transition-colors text-sm">{{ old('itinerary') }}</textarea>
                    <p class="text-xs text-slate-500 mt-2">Tuliskan jadwal harian secara rinci agar pelanggan mendapatkan gambaran yang jelas.</p>
                    @error('itinerary') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Section 3: Foto & Status --}}
        <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-slate-100">
            <h2 class="text-lg font-bold text-slate-800 mb-6">Foto & status</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Upload Foto --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Foto destinasi</label>
                    <label class="border-2 border-dashed border-slate-300 rounded-xl bg-slate-50 p-8 flex flex-col items-center justify-center text-center hover:bg-slate-100 transition-colors cursor-pointer w-full">
                        <i class="fas fa-upload text-2xl text-slate-400 mb-3"></i>
                        <p class="text-sm font-bold text-slate-700">Klik untuk unggah file</p>
                        <p class="text-xs text-slate-500 mt-1">JPEG / PNG / WebP, maks. 2MB</p>
                        <input type="file" name="foto" class="hidden" accept="image/jpeg, image/png, image/webp">
                    </label>
                    @error('foto') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Status Toggle --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Status paket</label>
                    <div class="flex items-start gap-3 mt-2">
                        {{-- Custom Toggle Switch --}}
                        <label class="relative inline-flex items-center cursor-pointer flex-shrink-0">
                            <input type="checkbox" name="status" value="aktif" class="sr-only peer" {{ old('status', 'aktif') == 'aktif' ? 'checked' : '' }}>
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
                <i class="fas fa-save"></i> Simpan paket
            </button>
        </div>
    </form>
</div>
@endsection