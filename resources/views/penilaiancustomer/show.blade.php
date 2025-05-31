@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 px-4">

    <h1 class="text-2xl font-bold mb-6">
        Detail Penilaian Customer untuk Guide: {{ $penilaians->first()->guide->nama_guide ?? 'Nama Guide' }}
    </h1>

    @php
        // Array warna background menggunakan HEX warna pastel
        $colors = ['#ebf8ff', '#f0fff4', '#fffff0', '#faf5ff', '#fff5f7'];
        $filteredIndex = 0;
        $filteredPenilaian = $penilaianFiltered = $penilaians->filter(fn($p) => isset($p->pesanan->user->name));
        $totalPenilaian = $penilaianFiltered->count();
    @endphp

    {{-- Loop per penilaian --}}
    @foreach ($penilaianFiltered as $penilaian)
        @php
            $namaPelanggan = $penilaian->pesanan->user->name;
            $details = $detailPelangganAll[$penilaian->id] ?? collect();
            $bgColor = $colors[$filteredIndex % count($colors)];
            $penilaianKe = $totalPenilaian - $filteredIndex;
            $filteredIndex++;
        @endphp

        <div class="mb-10 p-4 rounded" style="background-color: {{ $bgColor }};">
            <h2 class="text-xl font-semibold mb-1">
                Penilaian dari: {{ $namaPelanggan }} (Penilaian ke-{{ $penilaianKe }})
            </h2>
            <p class="text-sm text-gray-500">Tanggal: {{ $penilaian->created_at->format('d M Y H:i') }}</p>

            @if($details->isEmpty())
                <p class="mb-6 text-gray-600 italic">Tidak ada detail penilaian untuk penilaian ini.</p>
            @else
                <table class="w-full border-collapse border border-gray-300 mt-4">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2 text-left">Kriteria</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Subkriteria</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $detail)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $detail->subkriteria->kriteria->nama ?? '-' }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $detail->subkriteria->nama ?? '-' }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    {{ $detail->nilai }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endforeach

    <a href="{{ route('penilaian.customerList') }}"
       class="inline-block mt-4 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded">
       Kembali ke Daftar Guide
    </a>
</div>
@endsection
