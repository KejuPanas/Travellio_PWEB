@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-['Plus_Jakarta_Sans']">
    {{-- Breadcrumb & Header --}}
    <div class="text-sm text-slate-500 mb-4">
        <a href="{{ route('admin.bookings.index') }}" class="hover:text-blue-600">Kelola Booking</a> <i class="fas fa-chevron-right text-xs mx-1"></i> <span class="font-bold text-slate-800">Detail Booking VE-88291</span>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 mb-8">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center text-xl"><i class="fas fa-receipt"></i></div>
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Detail Booking</h1>
                <p class="text-slate-500 text-sm mt-0.5">ID Pesanan: <span class="font-bold bg-slate-100 px-2 py-0.5 rounded text-slate-700">VE-88291</span></p>
            </div>
        </div>
        <span class="px-4 py-2 bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-full text-xs font-extrabold tracking-wider flex items-center gap-2 w-max">
            <i class="fas fa-ellipsis-h"></i> MENUNGGU KONFIRMASI
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Kiri: Detail Pelanggan & Paket --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Info Pelanggan --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2"><i class="far fa-user text-blue-600"></i> Informasi Pelanggan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8 text-sm">
                    <div>
                        <p class="text-xs text-slate-500 font-bold mb-1">Nama Lengkap</p>
                        <p class="text-slate-900">Budi Santoso</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-bold mb-1">Email</p>
                        <p class="text-slate-900">budi.santoso@example.com</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-bold mb-1">Nomor Telepon / WhatsApp</p>
                        <p class="text-slate-900">+62 812-3456-7890</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-bold mb-1">Tanggal Pesan</p>
                        <p class="text-slate-900">24 Okt 2023, 14:30 WIB</p>
                    </div>
                </div>
            </div>

            {{-- Rincian Paket --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2"><i class="far fa-flag text-blue-600"></i> Rincian Paket</h3>
                <div class="flex flex-col sm:flex-row gap-6">
                    <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=300&q=80" class="w-full sm:w-48 h-48 object-cover rounded-xl shadow-sm">
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Eksplorasi Bali 4H3M</h2>
                            <p class="text-sm text-slate-500 mt-1 flex items-center gap-2"><i class="far fa-calendar-alt"></i> 12 Nov 2023 - 15 Nov 2023</p>
                        </div>
                        
                        <div class="bg-slate-50 rounded-xl p-4 mt-4 border border-slate-100">
                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-slate-500">Jumlah Peserta</span>
                                <span class="font-bold text-slate-900">2 Orang (Dewasa)</span>
                            </div>
                            <div class="flex justify-between text-sm pb-3 border-b border-slate-200">
                                <span class="text-slate-500">Harga per Orang</span>
                                <span class="text-slate-900">Rp 4.500.000</span>
                            </div>
                            <div class="flex justify-between items-end mt-3">
                                <span class="font-bold text-slate-900">Total Harga</span>
                                <span class="text-2xl font-extrabold text-blue-700">Rp 9.000.000</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Alert Cash --}}
                <div class="mt-4 bg-amber-50 border border-amber-200 rounded-xl p-4 flex gap-3 text-sm text-amber-800">
                    <i class="fas fa-info-circle mt-0.5 text-amber-600"></i>
                    <p>Metode Pembayaran: <b>Cash / Tunai di Kantor</b>. Pastikan pembayaran diterima sebelum mengubah status menjadi Berlangsung.</p>
                </div>
            </div>
        </div>

        {{-- Kanan: Action Admin --}}
        <div class="space-y-6">
            <div class="bg-blue-50/50 p-6 rounded-2xl shadow-sm border border-blue-100">
                <h3 class="text-lg font-bold text-blue-900 mb-2 flex items-center gap-2"><i class="fas fa-gavel"></i> Tindakan Admin</h3>
                <p class="text-xs text-blue-700 mb-4 leading-relaxed">Harap tinjau detail pesanan dan lakukan konfirmasi ketersediaan paket.</p>
                
                {{-- Form Konfirmasi --}}
                <form action="#" method="POST" class="mb-6">
                    @csrf @method('PATCH')
                    <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 rounded-xl transition-colors flex justify-center items-center gap-2 shadow-md">
                        <i class="fas fa-check-circle"></i> Konfirmasi Pesanan
                    </button>
                </form>

                <hr class="border-blue-200 mb-6">

                {{-- Form Tolak --}}
                <form action="#" method="POST">
                    @csrf @method('PATCH')
                    <label class="block text-xs font-bold text-slate-600 mb-1.5">Alasan Penolakan (Opsional)</label>
                    <textarea name="alasan" rows="2" placeholder="Tulis alasan jika menolak..." class="w-full p-3 border border-slate-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-red-500 mb-3"></textarea>
                    <button type="submit" class="w-full bg-white border border-red-500 hover:bg-red-50 text-red-600 font-bold py-2.5 rounded-xl transition-colors flex justify-center items-center gap-2">
                        <i class="far fa-times-circle"></i> Tolak Pesanan
                    </button>
                </form>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <h3 class="font-bold text-slate-800 mb-1">Update Status Perjalanan</h3>
                <p class="text-xs text-slate-400 mb-4">Ubah status setelah dikonfirmasi & dibayar.</p>
                <select class="w-full p-3 border border-slate-200 rounded-xl text-sm bg-slate-50 text-slate-400 outline-none" disabled>
                    <option>Menunggu Konfirmasi</option>
                </select>
            </div>
        </div>
    </div>
</div>
@endsection