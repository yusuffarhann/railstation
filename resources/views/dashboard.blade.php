@extends('layouts.app')

@section('content')
<div
    class="relative w-full h-36 bg-gradient-to-r from-[#3B82F6] to-[#8B5CF6] rounded-2xl p-6 mb-8 overflow-hidden shadow-lg flex items-center justify-between">
    <div class="text-white">
        <h2 class="text-2xl sm:text-3xl font-bold mb-2">Selamat Datang di Stasiun {{ $station->name }}</h2>
        <p class="text-lg font-light">Kelola operasional stasiun Anda dengan mudah.</p>
    </div>
</div>

<!-- Timeline Section -->
<section class="timeline-section">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-900">Timeline Perjalanan</h2>
        <span id="current-time-display" class="text-gray-500 text-sm">Waktu saat ini: --:--:--</span>
    </div>
    <div class="timeline">
        <div class="timeline-inner">
            <div class="timeline-hours"></div>
            <div class="timeline-minutes"></div>
            <div class="timeline-now" id="timeline-now" data-current-time=""></div>
            <div class="timeline-trains" id="timeline-trains"></div>
        </div>
    </div>
</section>

<!-- Grid Ringkasan Data -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- Kartu 1: Jumlah Pegawai -->
    <div
        class="bg-white rounded-xl shadow-md p-6 flex items-center space-x-4 transition-all duration-300 hover:scale-105">
        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100 text-blue-500">
            <i class="fas fa-users text-xl"></i>
        </div>
        <div>
            <h3 class="text-gray-500 text-sm">Jumlah Pegawai</h3>
            <p class="text-gray-900 text-2xl font-bold mt-1">{{ $totalEmployees }}</p>
        </div>
    </div>

    <!-- Kartu 2: Perjalanan Hari Ini -->
    <div
        class="bg-white rounded-xl shadow-md p-6 flex items-center space-x-4 transition-all duration-300 hover:scale-105">
        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100 text-blue-500">
            <i class="fas fa-train text-xl"></i>
        </div>
        <div>
            <h3 class="text-gray-500 text-sm">Perjalanan Hari Ini</h3>
            <p class="text-gray-900 text-2xl font-bold mt-1">{{ $totalTrains }}</p>
        </div>
    </div>

    <!-- Kartu 3: Perkiraan Cuaca -->
    <div
        class="bg-white rounded-xl shadow-md p-6 flex items-center space-x-4 transition-all duration-300 hover:scale-105">
        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100 text-blue-500">
            <i class="fas fa-cloud-sun text-xl"></i>
        </div>
        <div id="weather-data">
            <h3 class="text-gray-500 text-sm">Perkiraan Cuaca</h3>
            <p class="text-gray-900 text-2xl font-bold mt-1">...</p>
        </div>
    </div>
</div>

<!-- Bagian Data Pegawai Dinas Hari Ini -->
<div class="bg-white rounded-xl shadow-md p-6 mb-8">
    <h2 class="text-xl font-bold text-gray-900 mb-2">Data Pegawai yang Berdinas Hari Ini</h2>

    @foreach ($employeesPerShift as $shiftName => $employees)
    <p class="text-gray-700 font-semibold mb-4">{{ $shiftName }}</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @foreach ($employees as $employee)
        <div class="flex items-center space-x-4 bg-gray-50 rounded-lg p-4 shadow-sm">
            <img class="w-16 h-16 rounded-full object-cover"
                src="{{ $employee->photo_url ? asset($employee->photo_url) : 'https://placehold.co/128x128/D1D5DB/1F2937?text=' . $employee->position }}"
                alt="Foto {{ $employee->name }}">
            <div>
                <h3 class="font-bold text-lg text-gray-900">{{ $employee->position }}</h3>
                <p class="text-gray-700">Nama: {{ $employee->name }}</p>
                <p class="text-gray-700">NIPP: {{ $employee->nipp }}</p>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
