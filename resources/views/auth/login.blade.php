<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Travellio</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen font-['Plus_Jakarta_Sans'] text-slate-800 bg-white">

    {{-- Sisi Kiri: Background Full Height (Tersembunyi di Mobile) --}}
    <div class="hidden lg:flex lg:w-1/2 relative bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1000&q=80');">
        {{-- Gradient Overlay untuk membaca teks di bawah --}}
        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-900/40 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 p-12 w-full">
            <h1 class="text-4xl xl:text-5xl font-bold text-white leading-tight mb-4">
                Explore the World <br> with Ease.
            </h1>
            <p class="text-blue-50 text-lg max-w-md">
                Join thousands of travelers who trust VoyageEase for their seamless journeys and unforgettable memories.
            </p>
        </div>
    </div>

    {{-- Sisi Kanan: Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12">
        <div class="max-w-md w-full">
            
            <h2 class="text-3xl font-bold text-slate-900 mb-2">Welcome Back</h2>
            <p class="text-slate-500 mb-8 text-sm">Please enter your details to access your account.</p>

            {{-- Menampilkan Pesan Error (misal: password salah) --}}
            @if($errors->any())
                <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm font-bold flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Menampilkan Pesan Sukses (misal: sukses register) --}}
            @if(session('success'))
                <div class="mb-5 p-4 bg-green-50 border border-green-200 text-green-600 rounded-lg text-sm font-bold flex items-center gap-2">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form Login: Action sudah mengarah ke login.proses --}}
            <form action="{{ route('login.proses') }}" method="POST" class="space-y-5">
                @csrf
                
                {{-- Input Email --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Email Address</label>
                    {{-- Wajib ada name="email" --}}
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="name@company.com" 
                        class="w-full px-4 py-3 border @error('email') border-red-500 @else border-slate-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition-all text-sm">
                </div>

                {{-- Input Password --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Password</label>
                    <div class="relative">
                        {{-- Wajib ada name="password" --}}
                        <input type="password" name="password" required placeholder="••••••••" 
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition-all text-sm">
                        <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-slate-600">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500 cursor-pointer">
                        <label for="remember" class="text-sm text-slate-600 cursor-pointer">Remember me</label>
                    </div>
                    <a href="#" class="text-sm text-blue-700 font-semibold hover:underline">Forgot password?</a>
                </div>

                <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-4 rounded-lg transition-colors mt-4 shadow-md flex justify-center items-center gap-2">
                    Login <i class="fas fa-sign-in-alt"></i>
                </button>
            </form>

            <p class="text-center text-sm text-slate-600 mt-8">
                Don't have an account? <a href="{{ route('register') }}" class="text-blue-700 font-bold hover:underline">Register for free</a>
            </p>

        </div>
    </div>

</body>
</html>