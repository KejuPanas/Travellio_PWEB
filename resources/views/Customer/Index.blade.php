@extends('layouts.app')
@section('title', 'Riwayat Booking')

@section('content')
<div class="container section">
    <div class="page-title-row">
        <h1>Riwayat Booking</h1>
        <a href="{{ route('pakets') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Booking Baru
        </a>
    </div>

    @if($bookings->isEmpty())
        <div class="empty-state">
            <i class="fas fa-suitcase-rolling"></i>
            <h3>Belum ada booking</h3>
            <p>Mulai rencanakan perjalanan impianmu sekarang!</p>
            <a href="{{ route('pakets') }}" class="btn btn-primary">
                <i class="fas fa-map-marked-alt"></i> Lihat Paket Wisata
            </a>
        </div>
    @else
        <div class="section-card">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Kode Booking</th>
                            <th>Paket Wisata</th>
                            <th>Tgl. Berangkat</th>
                            <th>Peserta</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td><code class="booking-code">{{ $booking->kode_booking }}</code></td>
                                <td>{{ $booking->paketWisata->nama_paket }}</td>
                                <td>{{ $booking->tanggal_berangkat->format('d M Y') }}</td>
                                <td>{{ $booking->jumlah_peserta }} orang</td>
                                <td>{{ $booking->total_harga_format }}</td>
                                <td>
                                    <span class="badge {{ $booking->status_badge }}">{{ $booking->status }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('customer.bookings.show', $booking) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-wrapper">
                {{ $bookings->links('components.pagination') }}
            </div>
        </div>
    @endif
</div>
@endsection