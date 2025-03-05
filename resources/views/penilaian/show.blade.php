<!-- resources/views/penilaian/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Detail Penilaian: {{ $penilaian->nama_kandidat }}</h1>
    
    <h2 class="text-xl font-bold mt-4 mb-2">Hasil Perhitungan Profile Matching</h2>
    
    @foreach($hasil['detail'] as $kriteriaId => $detailKriteria)
        <h3 class="text-lg font-semibold mt-3">{{ $detailKriteria['nama'] }}</h3>
        <p>Nilai Core Factor: {{ number_format($detailKriteria['nilai_cf'], 2) }}</p>
        <p>Nilai Secondary Factor: {{ number_format($detailKriteria['nilai_sf'], 2) }}</p>
        <p>Nilai Total Kriteria: {{ number_format($detailKriteria['nilai_total'], 2) }}</p>
    @endforeach

    <h3 class="text-xl font-bold mt-4">Nilai Akhir: {{ number_format($hasil['nilai_akhir'], 2) }}</h3>

    <h2 class="text-xl font-bold mt-6 mb-2">Detail Penilaian</h2>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Kriteria</th>
                <th class="border border-gray-300 px-4 py-2">Subkriteria</th>
                <th class="border border-gray-300 px-4 py-2">Nilai</th>
                <th class="border border-gray-300 px-4 py-2">Profil Standar</th>
                <th class="border border-gray-300 px-4 py-2">Gap</th>
                <th class="border border-gray-300 px-4 py-2">Bobot Nilai</th>
                <th class="border border-gray-300 px-4 py-2">Jenis Faktor</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach($hasil['detail'] as $kriteriaId => $detailKriteria)
                @foreach($detailKriteria['detail'] as $detail)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $detailKriteria['nama'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $detail['nama_subkriteria'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $detail['nilai'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $detail['profil_standar'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $detail['gap'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ number_format($detail['bobot_nilai'], 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $detail['is_core_factor'] ? 'Core Factor' : 'Secondary Factor' }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

</div>
@endsection