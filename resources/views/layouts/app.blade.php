<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'NusaJelajah') — Sistem Booking Travel</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body>

    @include('layouts.navbar')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" id="flash-alert">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error alert-dismissible" id="flash-alert">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
            <button type="button" class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

    <script>
        setTimeout(() => {
            document.getElementById('flash-alert')?.remove();
        }, 4000);
    </script>
    
    @stack('scripts')
</body>
</html>