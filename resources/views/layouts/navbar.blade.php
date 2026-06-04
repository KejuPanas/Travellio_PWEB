<nav class="bg-white sticky top-0 z-50 border-b border-slate-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            {{-- Logo --}}
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="text-2xl font-extrabold text-blue-700 tracking-tight">Travellio</a>
            </div>

            {{-- Menu Tengah Dinamis --}}
            <div class="hidden md:flex space-x-8">
                @guest
                    <a href="/" class="text-blue-600 font-bold border-b-2 border-blue-600 py-1">Home</a>
                    <a href="{{ route('pakets') }}" class="text-slate-500 hover:text-blue-600 font-medium py-1 transition-colors">Paket Wisata</a>
                @endguest

                @auth
                    @if(Auth::user()->role === 'customer')
                        {{-- Menu Tengah Dinamis --}}
                        <div class="hidden md:flex space-x-8">
                            
                            {{-- 1. Menu Untuk Pengunjung Belum Login --}}
                            @guest
                                <a href="{{ route('home') }}" 
                                class="{{ request()->routeIs('home') ? 'text-blue-600 font-bold border-b-2 border-blue-600' : 'text-slate-500 hover:text-blue-600 font-medium' }} py-1 transition-colors">
                                Home
                                </a>
                                <a href="{{ route('pakets') }}" 
                                class="{{ request()->routeIs('paket*') ? 'text-blue-600 font-bold border-b-2 border-blue-600' : 'text-slate-500 hover:text-blue-600 font-medium' }} py-1 transition-colors">
                                Paket Wisata
                                </a>
                            @endguest

                            @auth
                                {{-- 2. Menu Untuk Customer --}}
                                @if(Auth::user()->role === 'customer')
                                    <a href="{{ route('customer.dashboard') }}" 
                                    class="{{ request()->routeIs('customer.dashboard') ? 'text-blue-600 font-bold border-b-2 border-blue-600' : 'text-slate-500 hover:text-blue-600 font-medium' }} py-1 transition-colors">
                                    Dashboard
                                    </a>
                                    <a href="{{ route('customer.bookings.index') }}" 
                                    class="{{ request()->routeIs('customer.bookings.*') ? 'text-blue-600 font-bold border-b-2 border-blue-600' : 'text-slate-500 hover:text-blue-600 font-medium' }} py-1 transition-colors">
                                    My Bookings
                                    </a>
                                    <a href="{{ route('pakets') }}" 
                                    class="{{ request()->routeIs('paket*') ? 'text-blue-600 font-bold border-b-2 border-blue-600' : 'text-slate-500 hover:text-blue-600 font-medium' }} py-1 transition-colors">
                                    Packages
                                    </a>
                                    
                                {{-- Menu Admin (Tetap seperti yang sudah kita perbaiki sebelumnya) --}}
                                @elseif(Auth::user()->role === 'admin')
                                    @endif
                            @endauth
                        </div>
                    @elseif(Auth::user()->role === 'admin')
                        {{-- Menu Admin Dashboard --}}
                        <a href="{{ route('admin.dashboard') }}" 
                           class="{{ request()->routeIs('admin.dashboard') ? 'text-blue-600 font-bold border-b-2 border-blue-600' : 'text-slate-500 hover:text-blue-600 font-medium' }} py-1 transition-colors">
                           Admin Dashboard
                        </a>
                        
                        {{-- Menu Kelola Paket --}}
                        <a href="{{ route('admin.pakets.index') }}" 
                           class="{{ request()->routeIs('admin.pakets.*') ? 'text-blue-600 font-bold border-b-2 border-blue-600' : 'text-slate-500 hover:text-blue-600 font-medium' }} py-1 transition-colors">
                           Kelola Paket
                        </a>

                        {{-- Menu Kelola Booking --}}
                        <a href="{{ route('admin.bookings.index') }}" 
                           class="{{ request()->routeIs('admin.bookings.*') ? 'text-blue-600 font-bold border-b-2 border-blue-600' : 'text-slate-500 hover:text-blue-600 font-medium' }} py-1 transition-colors">
                           Kelola Booking
                        </a>

                        {{-- Menu Pembayaran --}}
                        <a href="{{ route('admin.pembayaran.index') }}" 
                           class="{{ request()->routeIs('admin.pembayaran.*') ? 'text-blue-600 font-bold border-b-2 border-blue-600' : 'text-slate-500 hover:text-blue-600 font-medium' }} py-1 transition-colors">
                           Pembayaran
                        </a>
                    @endif
                @endauth
            </div>

            {{-- Sisi Kanan (Auth) --}}
            <div class="flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-blue-700 font-medium transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg font-medium transition-colors">Register</a>
                @endguest

                @auth
                    <div class="flex items-center gap-4">
                        <span class="text-sm font-bold text-slate-700 hidden sm:block">Halo, {{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-sm transition-colors">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>