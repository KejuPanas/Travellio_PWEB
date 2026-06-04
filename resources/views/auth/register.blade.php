<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - VoyageEase</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-green-50 min-h-screen flex items-center justify-center p-4 sm:p-8 font-['Plus_Jakarta_Sans'] text-slate-800">

    <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        
        {{-- Sisi Kiri: Teks & Gambar --}}
        <div class="hidden md:block">
            <h1 class="text-4xl lg:text-5xl font-extrabold text-blue-700 leading-tight mb-4">
                Start your next <br> adventure today.
            </h1>
            <p class="text-slate-600 text-lg mb-8 max-w-md">
                Join VoyageEase to unlock exclusive travel packages, personalized itineraries, and seamless booking experiences.
            </p>
            
            <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                <img src="https://images.unsplash.com/photo-1532274402911-5a369e4c4bb5?auto=format&fit=crop&w=800&q=80" alt="Road Trip" class="w-full h-72 object-cover">
                
                {{-- Floating Badge --}}
                <div class="absolute bottom-6 left-6 bg-white/95 backdrop-blur rounded-xl p-4 shadow-lg flex items-center gap-4 max-w-xs">
                    <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center flex-shrink-0 text-xl">
                        <i class="fas fa-shield-check"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-sm">Trusted by 10k+ Travelers</h4>
                        <p class="text-xs text-slate-500">Secure & verified bookings</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sisi Kanan: Form --}}
        <div class="bg-white p-8 sm:p-10 rounded-2xl shadow-xl w-full max-w-md mx-auto border border-slate-100">
            <h2 class="text-3xl font-bold text-slate-900 mb-2">Create Account</h2>
            <p class="text-slate-500 text-sm mb-8">Enter your details to register with VoyageEase</p>

            {{-- ACTION DIARAHKAN KE RUTE register.proses --}}
            <form action="{{ route('register.proses') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Input Name --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Full Name</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400"><i class="fas fa-user"></i></span>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Umar" 
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border @error('name') border-red-500 @else border-slate-200 @enderror rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition-all text-sm">
                    </div>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Input Email --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="umar@mail.com" 
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border @error('email') border-red-500 @else border-slate-200 @enderror rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition-all text-sm">
                    </div>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Input Phone --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Phone Number</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400"><i class="fas fa-phone"></i></span>
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+1 (555) 000-0000" 
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border @error('phone') border-red-500 @else border-slate-200 @enderror rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition-all text-sm">
                    </div>
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Input Password Grid --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" required placeholder="••••••••" 
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border @error('password') border-red-500 @else border-slate-200 @enderror rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition-all text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Confirm Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400"><i class="fas fa-history"></i></span>
                            {{-- WAJIB bernama password_confirmation --}}
                            <input type="password" name="password_confirmation" required placeholder="••••••••" 
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition-all text-sm">
                        </div>
                    </div>
                </div>
                @error('password') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror

                {{-- Checkbox --}}
                <div class="flex items-start gap-2 pt-2">
                    <input type="checkbox" name="terms" id="terms" required class="mt-1 w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500 cursor-pointer">
                    <label for="terms" class="text-xs text-slate-600 cursor-pointer">
                        I agree to the <a href="#" class="text-blue-600 hover:underline">Terms of Service</a> and <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>.
                    </label>
                </div>
                @error('terms') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror

                {{-- Submit Button --}}
                <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-4 rounded-lg transition-colors flex items-center justify-center gap-2 shadow-md">
                    Create Account <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            {{-- Divider --}}
            <div class="relative flex items-center justify-center py-6 mt-2">
                <hr class="w-full border-slate-200">
                <span class="absolute bg-white px-4 text-xs text-slate-400"></span>
            </div>

            <p class="text-center text-sm text-slate-600">
                Already have an account? <a href="{{ route('login') }}" class="text-blue-700 font-bold hover:underline">Sign In</a>
            </p>
        </div>
    </div>
</body>
</html>