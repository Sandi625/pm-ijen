@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Card 1: Total Penilaian -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-2">Total Penilaian</h2>
            <p class="text-3xl font-bold text-gray-800">{{ $totalPenilaian }}</p>
            <i class="fa-solid fa-clipboard-list text-blue-500 text-4xl mt-4"></i>
        </div>

        <!-- Card 2: Kriteria Terdaftar -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-2">Kriteria Terdaftar</h2>
            <p class="text-3xl font-bold text-gray-800">{{ $totalKriteria }}</p>
            <i class="fa-solid fa-list-alt text-green-500 text-4xl mt-4"></i>
        </div>

        <!-- Card 3: Subkriteria Terdaftar -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-2">Subkriteria Terdaftar</h2>
            <p class="text-3xl font-bold text-gray-800">{{ $totalSubkriteria }}</p>
            <i class="fa-solid fa-tags text-yellow-500 text-4xl mt-4"></i>
        </div>
    </div>

    <!-- Recent Penilaian Table -->
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Recent Penilaian</h2>
        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Nama Kandidat</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Tanggal Penilaian</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentPenilaians as $penilaian)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $penilaian->nama_kandidat }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $penilaian->created_at->format('d-m-Y') }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('penilaian.show', $penilaian) }}" class="inline-block text-blue-500 hover:text-blue-700">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
