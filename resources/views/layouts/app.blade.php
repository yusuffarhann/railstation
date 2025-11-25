<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Stasiun Kereta Api</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="flex">

    @include('layouts.sidebar')

    <!-- Bagian Tengah (Dashboard Utama) -->
    <div class="main-content flex-grow p-6 sm:p-8" id="main-content">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Dashboard Stasiun <span class="text-blue-600">{{ $station->name }}</span>
            </h1>
            <div class="flex space-x-4">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-6 rounded-full shadow-md hover:bg-blue-600 transition-colors duration-300">Logout</button>
                </form>
            </div>
        </div>

        <!-- Konten akan dimuat di sini -->
        <div id="content-container">
            @yield('content')
        </div>
    </div>

    @yield('modals')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/pagination-helper.js') }}"></script>
    <script>
        // logout function
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('login-button');
            if (btn) {
                btn.addEventListener('click', function() {
                    window.location.href = '/logout';
                });
            }
        });
    </script>
    @stack('scripts')
</body>

</html>