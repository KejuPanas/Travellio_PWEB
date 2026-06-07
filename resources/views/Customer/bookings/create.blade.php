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
                    <img src="{{ $paket->foto_url }}" class="w-24 h-24 rounded-lg object-cover">
                    <div>
                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded">{{ $paket->destinasi }}</span>
                        <h3 class="text-lg font-bold text-slate-900 mt-1">{{ $paket->nama_paket }}</h3>
                        <p class="text-sm text-slate-500 mt-1"><i class="fas fa-check-circle text-green-500"></i> {{ $paket->durasi_hari }} Hari &bull; Min. {{ $paket->min_peserta }} Peserta</p>
                    </div>
                </div>

                {{-- Input Form --}}
                <form action="{{ route('customer.bookings.store', $paket->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Pilih Tanggal Keberangkatan</label>
                            <input type="date" name="tanggal" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('tanggal') }}" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
                            @error('tanggal')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Jumlah Peserta</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"><i class="fas fa-user-friends"></i></span>
                                <input type="number" name="jumlah_peserta" id="jumlah_peserta" min="{{ $paket->min_peserta }}" max="{{ $paket->max_peserta ?? '' }}" value="{{ old('jumlah_peserta', $paket->min_peserta) }}" required class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
                            </div>
                            @error('jumlah_peserta')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Catatan Khusus (Opsional)</label>
                        <textarea name="catatan" rows="3" placeholder="Contoh: Alergi makanan, permintaan kursi roda..." class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">{{ old('catatan') }}</textarea>
                        @error('catatan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Upload Bukti Transfer --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Upload Bukti Transfer DP (50%)</label>
                        <div class="relative border-2 border-dashed border-slate-300 rounded-lg p-4 text-center hover:border-blue-600 transition-colors">
                            <input type="file" name="bukti_transfer" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" id="bukti_transfer_input" accept="image/*">
                            <div class="space-y-1" id="upload-placeholder">
                                <i class="fas fa-cloud-upload-alt text-slate-400 text-2xl"></i>
                                <p class="text-xs text-slate-500">Klik atau seret file gambar bukti transfer untuk diunggah</p>
                                <p class="text-[10px] text-slate-400">PNG, JPG, JPEG, WEBP (Maks 2MB)</p>
                            </div>
                            <div class="hidden space-y-1 text-green-600 font-bold" id="upload-success">
                                <i class="fas fa-check-circle text-2xl"></i>
                                <p class="text-xs" id="file-name-text">File terpilih!</p>
                            </div>
                        </div>
                        @error('bukti_transfer')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Rekening Transfer DP --}}
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 mt-6">
                        <h4 class="font-bold text-blue-900 mb-2"><i class="fas fa-university text-lg mr-1.5"></i> Rekening Transfer Uang Muka (DP 50%)</h4>
                        <p class="text-xs text-blue-800 mb-3">Harap lakukan transfer DP sebesar 50% dari total biaya ke rekening resmi kami di bawah ini:</p>
                        <div class="bg-white p-3 rounded-lg border border-blue-100 space-y-1.5 text-xs">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Bank</span>
                                <span class="font-bold text-slate-900">Bank Central Asia (BCA)</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Nomor Rekening</span>
                                <span class="font-bold text-blue-700 tracking-wider">123-456-7890</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Atas Nama</span>
                                <span class="font-bold text-slate-900">CV Travellio Travel Indonesia</span>
                            </div>
                        </div>
                        <p class="text-[11px] text-slate-500 mt-3 leading-relaxed"><i class="fas fa-exclamation-circle text-amber-500"></i> Silakan transfer menggunakan Mobile Banking / ATM, lalu screenshot bukti transfernya dan upload di atas.</p>
                    </div>

                    {{-- Info Pelunasan Cash --}}
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-5 flex gap-4 mt-6">
                        <i class="fas fa-money-bill-wave text-yellow-600 text-xl mt-1"></i>
                        <div>
                            <h4 class="font-bold text-yellow-800">Informasi Pelunasan</h4>
                            <p class="text-xs text-yellow-700 mt-1">Sisa pelunasan 50% dibayarkan secara **tunai / cash** kepada perwakilan travel kami saat bertemu di meeting point (titik kumpul).</p>
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-8 rounded-lg shadow-md transition-all">Submit Pemesanan</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Kanan: Summary --}}
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Ringkasan Biaya</h3>
                <div class="space-y-3 text-sm text-slate-600 border-b border-slate-100 pb-4 mb-4">
                    <div class="flex justify-between"><span>Harga Dasar (per orang)</span><span>Rp {{ number_format($paket->harga_per_orang, 0, ',', '.') }}</span></div>
                    <div class="flex justify-between"><span id="detail-jumlah-peserta-text">Jumlah Peserta ({{ $paket->min_peserta }})</span><span id="detail-total-base-text">Rp 0</span></div>
                    <div class="flex justify-between text-green-600"><span class="flex items-center gap-1">Pajak & Layanan <i class="fas fa-info-circle text-xs"></i></span><span>Termasuk</span></div>
                </div>
                <div class="space-y-3 text-sm text-slate-600 border-b border-slate-100 pb-4 mb-4">
                    <div class="flex justify-between items-end">
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Biaya</p>
                            <h3 class="text-lg font-bold text-slate-800" id="total-harga-text">Rp 0</h3>
                        </div>
                    </div>
                    <div class="flex justify-between items-end">
                        <div>
                            <p class="text-xs font-bold text-blue-600 uppercase tracking-wider">Wajib Bayar DP (50%)</p>
                            <h2 class="text-2xl font-bold text-blue-600" id="nominal-dp-text">Rp 0</h2>
                        </div>
                    </div>
                </div>
                
                <div class="bg-slate-50 p-4 rounded-lg flex gap-3 items-start border border-slate-100">
                    <i class="fas fa-map-marker-alt text-blue-600 mt-1"></i>
                    <div>
                        <p class="text-xs font-bold text-slate-900">Titik Pertemuan:</p>
                        <p class="text-[11px] text-slate-500 mt-1">Akan diinfokan lebih lanjut oleh pemandu wisata di halaman detail pemesanan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jumlahPesertaInput = document.getElementById('jumlah_peserta');
        const totalHargaText = document.getElementById('total-harga-text');
        const nominalDpText = document.getElementById('nominal-dp-text');
        const detailJumlahPesertaText = document.getElementById('detail-jumlah-peserta-text');
        const detailTotalBaseText = document.getElementById('detail-total-base-text');
        const hargaPerOrang = {{ $paket->harga_per_orang }};
        
        function formatRupiah(number) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(number);
        }

        function updatePrices() {
            const qty = parseInt(jumlahPesertaInput.value) || 1;
            const total = qty * hargaPerOrang;
            const dp = total * 0.50; // DP 50%

            totalHargaText.textContent = formatRupiah(total);
            nominalDpText.textContent = formatRupiah(dp);
            detailJumlahPesertaText.textContent = `Jumlah Peserta (${qty})`;
            detailTotalBaseText.textContent = formatRupiah(total);
        }

        jumlahPesertaInput.addEventListener('input', updatePrices);
        jumlahPesertaInput.addEventListener('change', updatePrices);

        // File upload preview
        const fileInput = document.getElementById('bukti_transfer_input');
        const placeholder = document.getElementById('upload-placeholder');
        const success = document.getElementById('upload-success');
        const nameText = document.getElementById('file-name-text');

        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                placeholder.classList.add('hidden');
                success.classList.remove('hidden');
                nameText.textContent = fileInput.files[0].name;
            } else {
                placeholder.classList.remove('hidden');
                success.classList.add('hidden');
            }
        });

        // Initial calculation
        updatePrices();
    });
</script>
@endsection