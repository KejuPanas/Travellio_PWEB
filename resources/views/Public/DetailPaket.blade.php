@extends('layouts.app')
@section('title', $paketWisata->nama_paket)

@section('content')
<div class="container section">
    <a href="{{ route('pakets') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Paket
    </a>

    <div class="detail-layout">
        {{-- Main Content --}}
        <div class="detail-main">
            <div class="detail-img-wrapper">
                <img src="{{ $paketWisata->foto_url }}" alt="{{ $paketWisata->nama_paket }}"
                     onerror="this.src='https://placehold.co/900x500/1a6b5a/white?text={{ urlencode($paketWisata->nama_paket) }}'">
                <div class="detail-img-badge">
                    <i class="fas fa-location-dot"></i> {{ $paketWisata->destinasi }}
                </div>
            </div>

            <div class="detail-card">
                <div class="detail-meta-row">
                    <span class="detail-meta-item"><i class="fas fa-clock"></i> {{ $paketWisata->durasi_hari }} Hari</span>
                    <span class="detail-meta-item"><i class="fas fa-users"></i> Min. {{ $paketWisata->min_peserta }} orang</span>
                    @if($paketWisata->max_peserta)
                        <span class="detail-meta-item"><i class="fas fa-users"></i> Maks. {{ $paketWisata->max_peserta }} orang</span>
                    @endif
                    <span class="detail-meta-item"><i class="fas fa-location-dot"></i> {{ $paketWisata->destinasi }}</span>
                </div>

                <h1 class="detail-title">{{ $paketWisata->nama_paket }}</h1>

                <div class="detail-section">
                    <h2 class="detail-section-title"><i class="fas fa-info-circle"></i> Deskripsi</h2>
                    <p class="detail-desc">{{ $paketWisata->deskripsi }}</p>
                </div>

                <div class="detail-section">
                    <h2 class="detail-section-title"><i class="fas fa-route"></i> Itinerary</h2>
                    <div class="itinerary-content">
                        {!! nl2br(e($paketWisata->itinerary)) !!}
                    </div>
                </div>

                <div class="detail-section">
                    <h2 class="detail-section-title"><i class="fas fa-circle-info"></i> Informasi Pembayaran</h2>
                    <div class="info-box info-box-blue">
                        <i class="fas fa-money-bill-wave"></i>
                        <div>
                            <strong>Pembayaran Cash di Meeting Point</strong>
                            <p>Pembayaran dilakukan secara cash kepada perwakilan kami pada hari keberangkatan di meeting point yang telah disepakati.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Related Packages --}}
            @if($related->isNotEmpty())
            <div class="detail-card">
                <h2 class="detail-section-title">Paket Lainnya</h2>
                <div class="paket-grid paket-grid-3col">
                    @foreach($related as $rel)
                        <div class="paket-card paket-card-mini">
                            <a href="{{ route('paket.show', $rel) }}">
                                <img src="{{ $rel->foto_url }}" alt="{{ $rel->nama_paket }}"
                                     onerror="this.src='https://placehold.co/400x250/1a6b5a/white?text=Paket'">
                            </a>
                            <div class="paket-card-body">
                                <h4><a href="{{ route('paket.show', $rel) }}">{{ $rel->nama_paket }}</a></h4>
                                <strong class="price-tag">{{ $rel->harga_format }}</strong>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        {{-- Booking Sidebar --}}
        <aside class="detail-sidebar">
            <div class="booking-card sticky-card">
                <div class="booking-card-price">
                    <span>Mulai dari</span>
                    <strong>{{ $paketWisata->harga_format }}</strong>
                    <span class="price-per">/orang</span>
                </div>

                <div class="booking-card-info">
                    <div class="booking-info-row">
                        <span><i class="fas fa-clock"></i> Durasi</span>
                        <strong>{{ $paketWisata->durasi_hari }} Hari</strong>
                    </div>
                    <div class="booking-info-row">
                        <span><i class="fas fa-users"></i> Min. Peserta</span>
                        <strong>{{ $paketWisata->min_peserta }} Orang</strong>
                    </div>
                    <div class="booking-info-row">
                        <span><i class="fas fa-money-bill"></i> Pembayaran</span>
                        <strong>Cash</strong>
                    </div>
                </div>

                @auth
                    @if(auth()->user()->isCustomer())
                        <a href="{{ route('customer.bookings.create', $paketWisata) }}" class="btn btn-primary btn-block btn-lg">
                            <i class="fas fa-calendar-plus"></i> Booking Sekarang
                        </a>
                    @else
                        <div class="info-box info-box-yellow">
                            <small>Login sebagai admin. Kamu tidak bisa booking.</small>
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}?redirect={{ route('customer.bookings.create', $paketWisata) }}" class="btn btn-primary btn-block btn-lg">
                        <i class="fas fa-right-to-bracket"></i> Login untuk Booking
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-block mt-2">
                        <i class="fas fa-user-plus"></i> Daftar Gratis
                    </a>
                @endauth
            </div>
        </aside>
    </div>
</div>
@endsection