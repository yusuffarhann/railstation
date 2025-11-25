@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-md p-6 mb-8">
    <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Identifikasi Bahaya dan Penilaian Risiko (IBPR)</h1>
        @if(auth()->user()->role != 'station_master' || (auth()->user()->role == 'station_master' &&
                    auth()->user()->station_id == $station->id))
        <div id="ibpr-edit-buttons-container" class="flex space-x-2">
            <button id="ibpr-edit-btn"
                class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-full shadow-md hover:bg-blue-600 transition-colors duration-300">Edit
                Data</button>
            <button id="ibpr-save-btn"
                class="bg-green-500 text-white font-semibold py-2 px-4 rounded-full shadow-md hover:bg-green-600 transition-colors duration-300 hidden">Simpan</button>
            <button id="ibpr-cancel-btn"
                class="bg-red-500 text-white font-semibold py-2 px-4 rounded-full shadow-md hover:bg-red-600 transition-colors duration-300 hidden">Batal</button>
        </div>
        @endif
    </div>

    <div class="ibpr-table-container">
        <table class="ibpr-table">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th colspan="2">Identifikasi Bahaya</th>
                    <th colspan="6">Kontrol yang Ada</th>
                    <th colspan="4">Penilaian Risiko</th>
                    <th colspan="4">Rencana Tindak Lanjut</th>
                    <th colspan="3">Penilaian Risiko Setelah Tindak Lanjut</th>
                    <th rowspan="3" id="ibpr-opsi-header" class="hidden">Opsi</th>
                </tr>
                <tr>
                    <th rowspan="2">ID</th>
                    <th rowspan="2">Bahaya</th>
                    <th rowspan="2">Penjelasan Kontrol</th>
                    <th rowspan="2">Referensi</th>
                    <th colspan="3">Efektivitas</th>
                    <th rowspan="2">Posisi Penanggung Jawab</th>
                    <th rowspan="2">Penjelasan Risiko</th>
                    <th rowspan="2">Probabilitas</th>
                    <th rowspan="2">Dampak</th>
                    <th rowspan="2">Nilai Risiko</th>
                    <th rowspan="2">Penjelasan Rencana Tindak Lanjut</th>
                    <th rowspan="2">Referensi</th>
                    <th rowspan="2">Posisi Penanggung Jawab</th>
                    <th rowspan="2">Tanggal Selesai</th>
                    <th rowspan="2">Probabilitas</th>
                    <th rowspan="2">Dampak</th>
                    <th rowspan="2">Nilai Risiko</th>
                </tr>
                <tr>
                    <th>Tinggi</th>
                    <th>Sedang</th>
                    <th>Rendah</th>
                </tr>
            </thead>
            <tbody id="ibpr-table-body">
                <!-- Data will be populated by JavaScript -->
            </tbody>
        </table>
    </div>
    <div id="add-ibpr-row-container" class="mt-4 text-center hidden">
        <button id="add-ibpr-row-btn"
            class="bg-blue-500 text-white font-semibold py-2 px-6 rounded-full shadow-md hover:bg-blue-600 transition-colors duration-300">Tambah
            Baris</button>
    </div>

    <x-pagination :paginationId="'ibpr'" />
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/ibpr.js') }}"></script>
@endpush
