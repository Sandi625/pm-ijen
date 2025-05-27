@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <h1 class="text-2xl font-bold mb-4">Detail Penilaian Customer untuk Guide: {{ $penilaian->guide->nama_guide ?? 'Nama Guide' }}</h1>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <h2 class="text-xl font-semibold mb-4">Penilaian Pelanggan</h2>

  @php
    // Potong setiap 9 entri untuk ditampilkan sebagai satu tabel (jika satu penilaian terdiri dari 9 kriteria)
    $chunks = $detailPelanggan->chunk(9);
@endphp

@foreach ($chunks as $index => $details)
    <h3 class="text-lg font-semibold mb-2">Penilaian ke-{{ $index + 1 }}</h3>

    <table class="w-full border-collapse border border-gray-300 mb-8">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2 text-left">Kriteria</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Subkriteria</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Nilai</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Nama Pelanggan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $detail)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">{{ $detail->subkriteria->kriteria->nama ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $detail->subkriteria->nama ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $detail->nilai }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $detail->penilaian->pesanan->user->name ?? 'Tidak Diketahui' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach


    <a href="{{ route('penilaian.customerList') }}"
       class="inline-block mt-4 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded">
       Kembali ke Daftar Guide
    </a>
</div>
@endsection
