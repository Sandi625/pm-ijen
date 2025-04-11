@extends('layouts.base')

@section('content')
<div class="flex justify-center mt-10 px-4">
    <div class="w-full max-w-6xl">
        <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Dashboard</h1>

        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            <!-- Card 1 -->
            <div class="relative bg-white shadow-md rounded-2xl p-6 transition-transform hover:scale-[1.02]">
                <h2 class="text-lg font-semibold text-gray-700">Total Penilaian</h2>
                <p class="text-4xl font-bold text-gray-900 mt-2">{{ $totalPenilaian }}</p>
                <div class="absolute bottom-4 right-4 text-blue-500 text-5xl">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="relative bg-white shadow-md rounded-2xl p-6 transition-transform hover:scale-[1.02]">
                <h2 class="text-lg font-semibold text-gray-700">Kriteria Terdaftar</h2>
                <p class="text-4xl font-bold text-gray-900 mt-2">{{ $totalKriteria }}</p>
                <div class="absolute bottom-4 right-4 text-green-500 text-5xl">
                    <i class="fa-solid fa-list-alt"></i>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="relative bg-white shadow-md rounded-2xl p-6 transition-transform hover:scale-[1.02]">
                <h2 class="text-lg font-semibold text-gray-700">Subkriteria Terdaftar</h2>
                <p class="text-4xl font-bold text-gray-900 mt-2">{{ $totalSubkriteria }}</p>
                <div class="absolute bottom-4 right-4 text-yellow-500 text-5xl">
                    <i class="fa-solid fa-tags"></i>
                </div>
            </div>
        </div>

        <!-- Tabel Penilaian Terbaru -->
        <div class="bg-white shadow-md rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Penilaian Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Nama Guide</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Tanggal Penilaian</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentPenilaians as $penilaian)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-3 text-gray-800">{{ $penilaian->guide->nama_guide ?? '-' }}</td>
                                <td class="px-6 py-3 text-gray-800">{{ $penilaian->created_at->format('d-m-Y') }}</td>
                                <td class="px-6 py-3">
                                    <a href="{{ route('penilaian.show', $penilaian) }}" class="text-blue-500 hover:text-blue-700">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center px-6 py-4 text-gray-500">Belum ada data penilaian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
