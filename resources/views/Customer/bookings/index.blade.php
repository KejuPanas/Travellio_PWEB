@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-['Plus_Jakarta_Sans']">
    
    <div class="flex justify-between items-end mb-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Riwayat Pemesanan</h1>
            <p class="text-slate-500 mt-1">Kelola dan pantau semua rencana perjalanan Anda.</p>
        </div>
    </div>

    {{-- Tabs Status --}}
    <div class="flex gap-2 mb-6 overflow-x-auto pb-2" id="status-tabs">
        <button data-status="all" class="tab-btn bg-blue-700 text-white px-5 py-2 rounded-full text-sm font-bold shadow-sm whitespace-nowrap">Semua ({{ $bookings->count() }})</button>
        <button data-status="Pending" class="tab-btn bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-5 py-2 rounded-full text-sm font-bold whitespace-nowrap">Pending ({{ $bookings->where('status', 'Pending')->count() }})</button>
        <button data-status="Dikonfirmasi" class="tab-btn bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-5 py-2 rounded-full text-sm font-bold whitespace-nowrap">Dikonfirmasi ({{ $bookings->where('status', 'Dikonfirmasi')->count() }})</button>
        <button data-status="Berlangsung" class="tab-btn bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-5 py-2 rounded-full text-sm font-bold whitespace-nowrap">Berlangsung ({{ $bookings->where('status', 'Berlangsung')->count() }})</button>
        <button data-status="Selesai" class="tab-btn bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-5 py-2 rounded-full text-sm font-bold whitespace-nowrap">Selesai ({{ $bookings->where('status', 'Selesai')->count() }})</button>
        <button data-status="Ditolak" class="tab-btn bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-5 py-2 rounded-full text-sm font-bold whitespace-nowrap">Ditolak ({{ $bookings->where('status', 'Ditolak')->count() }})</button>
    </div>

    {{-- Tabel Riwayat --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead class="bg-slate-50">
                    <tr class="text-slate-500 text-xs uppercase tracking-wider">
                        <th class="p-4 font-bold">Destinasi & ID</th>
                        <th class="p-4 font-bold">Tanggal</th>
                        <th class="p-4 font-bold">Status</th>
                        <th class="p-4 font-bold">Total Harga</th>
                        <th class="p-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-slate-100">
                    @forelse($bookings as $booking)
                    <tr class="booking-row hover:bg-slate-50 transition" data-status="{{ $booking->status }}">
                        <td class="p-4 flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-plane-departure"></i>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">{{ optional($booking->paketWisata)->nama_paket ?? 'Paket Terhapus' }}</p>
                                <p class="text-xs text-slate-400">{{ $booking->kode_booking }}</p>
                            </div>
                        </td>
                        <td class="p-4 text-slate-600">{{ $booking->tanggal_berangkat->format('d M Y') }}</td>
                        <td class="p-4">
                            @php
                                $badgeClass = match($booking->status) {
                                    'Pending' => 'bg-yellow-100 text-yellow-700',
                                    'Dikonfirmasi' => 'bg-green-100 text-green-700',
                                    'Berlangsung' => 'bg-blue-100 text-blue-700',
                                    'Selesai' => 'bg-slate-100 text-slate-700',
                                    'Ditolak' => 'bg-red-100 text-red-700',
                                    default => 'bg-slate-100 text-slate-700'
                                };
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $badgeClass }}">{{ $booking->status }}</span>
                        </td>
                        <td class="p-4 font-bold text-slate-900">{{ $booking->total_harga_format }}</td>
                        <td class="p-4 text-center">
                            <a href="{{ route('customer.bookings.show', $booking->id) }}" class="text-blue-600 hover:text-blue-800 bg-blue-50 p-2 rounded-lg inline-flex items-center"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-slate-400">Belum ada riwayat pemesanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('#status-tabs .tab-btn');
        const rows = document.querySelectorAll('tbody tr.booking-row');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Reset active tab
                tabs.forEach(t => {
                    t.classList.remove('bg-blue-700', 'text-white');
                    t.classList.add('bg-white', 'border', 'border-slate-200', 'text-slate-600', 'hover:bg-slate-50');
                });

                // Set active tab
                tab.classList.remove('bg-white', 'border', 'border-slate-200', 'text-slate-600', 'hover:bg-slate-50');
                tab.classList.add('bg-blue-700', 'text-white');

                const status = tab.getAttribute('data-status');

                rows.forEach(row => {
                    if (status === 'all' || row.getAttribute('data-status') === status) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endsection