@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-['Plus_Jakarta_Sans']">
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Kiri: Form --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="flex items-center gap-4 mb-2">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl"><i class="fas fa-clipboard-list"></i></div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">Formulir Pemesanan</h2>
                    <p class="text-slate-500 text-sm">Selesaikan detail perjalanan Anda untuk memesan paket ini.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                {{-- Paket Info Banner --}}
                <div class="flex gap-4 border border-slate-200 rounded-xl p-4 mb-6">
                    <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=200&q=80" class="w-24 h-24 rounded-lg object-cover">
                    <div>
                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded">Paket Populer</span>
                        <h3 class="text-lg font-bold text-slate-900 mt-1">Eksplorasi Budaya Bali</h3>
                        <p class="text-sm text-slate-500 mt-1"><i class="fas fa-check-circle text-green-500"></i> Tersedia Hari Ini</p>
                    </div>
                </div>

                {{-- Input Form --}}
                <form action="{{ route('customer.bookings.store', 1) }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Pilih Tanggal Keberangkatan</label>
                            <input type="date" name="tanggal" required class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Jumlah Peserta</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"><i class="fas fa-user-friends"></i></span>
                                <input type="number" name="jumlah_peserta" min="1" value="1" required class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Catatan Khusus (Opsional)</label>
                        <textarea name="catatan" rows="3" placeholder="Contoh: Alergi makanan, permintaan kursi roda..." class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none"></textarea>
                    </div>

                    {{-- Info Pembayaran Cash --}}
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-5 flex gap-4 mt-6">
                        <i class="fas fa-money-bill-wave text-yellow-600 text-xl mt-1"></i>
                        <div>
                            <h4 class="font-bold text-yellow-800">Informasi Pembayaran</h4>
                            <p class="text-sm text-yellow-700 mt-1">Demi kenyamanan Anda, kami hanya menerima <b>pembayaran tunai di titik pertemuan</b> (meeting point). Tidak perlu kartu kredit atau transfer di muka.</p>
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-8 rounded-lg shadow-md transition-all">Konfirmasi Pesanan</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Kanan: Summary --}}
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Ringkasan Biaya</h3>
                <div class="space-y-3 text-sm text-slate-600 border-b border-slate-100 pb-4 mb-4">
                    <div class="flex justify-between"><span>Harga Dasar (per orang)</span><span>Rp 1.250.000</span></div>
                    <div class="flex justify-between"><span>Jumlah Peserta (1)</span><span>Rp 1.250.000</span></div>
                    <div class="flex justify-between text-green-600"><span class="flex items-center gap-1">Pajak & Layanan <i class="fas fa-info-circle"></i></span><span>Termasuk</span></div>
                </div>
                <div class="flex justify-between items-end mb-6">
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Pembayaran</p>
                        <h2 class="text-2xl font-bold text-blue-600">Rp 1.250.000</h2>
                    </div>
                    <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded">Best Price</span>
                </div>
                
                <div class="bg-slate-50 p-4 rounded-lg flex gap-3 items-start border border-slate-100">
                    <i class="fas fa-map-marker-alt text-blue-600 mt-1"></i>
                    <div>
                        <p class="text-xs font-bold text-slate-900">Titik Pertemuan:</p>
                        <p class="text-xs text-slate-500 mt-1">Bandara Internasional Ngurah Rai, Terminal Kedatangan Domestik.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection