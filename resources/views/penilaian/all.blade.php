@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <h1 class="text-2xl font-bold mb-4">Hasil Perhitungan Profile Matching</h1>
    <div class="mb-5 space-x-2">
        <a href="{{ route('penilaian.pdf.all') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            Cetak Semua Penilaian
        </a>
        <a href="{{ route('penilaian.pdf.accepted') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
            Cetak Penilaian Diterima
        </a>
        <a href="{{ route('penilaian.pdf.rejected') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
            Cetak Penilaian Ditolak
        </a>
    </div>
    @foreach($hasilPerKriteria as $kriteriaId => $kriteriaData)
        <div class="mb-12">
            <h2 class="text-xl font-bold mb-4">Kriteria: {{ $kriteriaData['nama_kriteria'] }}</h2>

            <h3 class="text-lg font-semibold mt-4 mb-2">Tabel Pembobotan {{ $kriteriaData['nama_kriteria'] }}</h3>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">No.</th>
                            <th class="border border-gray-300 px-4 py-2">Nama Calon</th>
                            <th class="border border-gray-300 px-4 py-2">Kriteria</th>
                            @foreach($kriteriaData['subkriterias'] as $index => $subkriteria)
                                <th class="border border-gray-300 px-4 py-2">K{{ $index + 1 }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($kriteriaData['kandidat_results'] as $index => $kandidatResult)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $kandidatResult['nama_kandidat'] }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $kriteriaData['nama_kriteria'] }}</td>
                                @foreach($kriteriaData['subkriterias'] as $subkriteria)
                                    @php
                                        $subkriteriaResult = collect($kandidatResult['detail'])->firstWhere('subkriteria_id', $subkriteria->id);
                                    @endphp
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $subkriteriaResult ? $subkriteriaResult['nilai'] : '-' }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="border border-gray-300 px-4 py-2 font-semibold">Profil Standar</td>
                            @foreach($kriteriaData['subkriterias'] as $subkriteria)
                                <td class="border border-gray-300 px-4 py-2">{{ $subkriteria->profil_standar }}</td>
                            @endforeach
                        </tr>
                        @foreach($kriteriaData['kandidat_results'] as $index => $kandidatResult)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $kandidatResult['nama_kandidat'] }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $kriteriaData['nama_kriteria'] }}</td>
                                @foreach($kriteriaData['subkriterias'] as $subkriteria)
                                    @php
                                        $subkriteriaResult = collect($kandidatResult['detail'])->firstWhere('subkriteria_id', $subkriteria->id);
                                    @endphp
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $subkriteriaResult ? $subkriteriaResult['gap'] : '-' }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h3 class="text-lg font-semibold mt-4 mb-2">Tabel Hasil Bobot {{ $kriteriaData['nama_kriteria'] }}</h3>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">No.</th>
                            <th class="border border-gray-300 px-4 py-2">Nama Calon</th>
                            <th class="border border-gray-300 px-4 py-2">Kriteria</th>
                            <th class="border border-gray-300 px-4 py-2">GAP</th>
                            @foreach($kriteriaData['subkriterias'] as $index => $subkriteria)
                                <th class="border border-gray-300 px-4 py-2">K{{ $index + 1 }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($kriteriaData['kandidat_results'] as $index => $kandidatResult)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $kandidatResult['nama_kandidat'] }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $kriteriaData['nama_kriteria'] }}</td>

                                @php
                                    $totalGAP = 0;
                                    $jumlahSubkriteria = count($kriteriaData['subkriterias']);
                                @endphp

                                @foreach($kriteriaData['subkriterias'] as $subkriteria)
                                    @php
                                        $subkriteriaResult = collect($kandidatResult['detail'])->firstWhere('subkriteria_id', $subkriteria->id);
                                        $nilaiKandidat = $subkriteriaResult ? $subkriteriaResult['bobot_nilai'] : 0;
                                        $nilaiStandar = $subkriteria->bobot_ideal ?? 0; // Pastikan ada nilai standar
                                        $gap = $nilaiKandidat - $nilaiStandar;
                                        $totalGAP += $gap;
                                    @endphp
                                    <td class="border border-gray-300 px-4 py-2">{{ $nilaiKandidat }}</td>
                                @endforeach

                                <td class="border border-gray-300 px-4 py-2 ">{{ round($totalGAP / $jumlahSubkriteria, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    @endforeach

    <h2 class="text-xl font-bold mb-4">Tabel Pengelompokan Nilai Bobot GAP per Kriteria</h2>
    @foreach($hasilPerKriteria as $kriteriaId => $kriteriaData)
        <div class="mb-8">
            <h3 class="text-lg font-semibold mt-4 mb-2">{{ $kriteriaData['nama_kriteria'] }}</h3>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">No.</th>
                            <th class="border border-gray-300 px-4 py-2">Nama Calon</th>
                            @foreach($kriteriaData['subkriterias'] as $index => $subkriteria)
                                <th class="border border-gray-300 px-4 py-2">K{{ $index + 1 }}</th>
                            @endforeach
                            <th class="border border-gray-300 px-4 py-2">Core Factor</th>
                            <th class="border border-gray-300 px-4 py-2">Secondary Factor</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($kriteriaData['kandidat_results'] as $index => $kandidatResult)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $kandidatResult['nama_kandidat'] }}</td>
                                @foreach($kriteriaData['subkriterias'] as $subkriteria)
                                    @php
                                        $subkriteriaResult = collect($kandidatResult['detail'])->firstWhere('subkriteria_id', $subkriteria->id);
                                    @endphp
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $subkriteriaResult ? $subkriteriaResult['bobot_nilai'] : '-' }}
                                    </td>
                                @endforeach
                                <td class="border border-gray-300 px-4 py-2">{{ number_format($kandidatResult['nilai_cf'], 2) }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ number_format($kandidatResult['nilai_sf'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach

    <h2 class="text-xl font-bold mb-4">Tabel Perhitungan Nilai Total</h2>
    @foreach($hasilPerKriteria as $kriteriaId => $kriteriaData)
        <div class="mb-8">
            <h3 class="text-lg font-semibold mt-4 mb-2">{{ $kriteriaData['nama_kriteria'] }}</h3>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">No.</th>
                            <th class="border border-gray-300 px-4 py-2">Nama Kandidat</th>
                            <th class="border border-gray-300 px-4 py-2">Nilai CF</th>
                            <th class="border border-gray-300 px-4 py-2">Nilai SF</th>
                            <th class="border border-gray-300 px-4 py-2">Nilai Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($kriteriaData['kandidat_results'] as $index => $kandidatResult)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $kandidatResult['nama_kandidat'] }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ number_format($kandidatResult['nilai_cf'], 2) }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ number_format($kandidatResult['nilai_sf'], 2) }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ number_format($kandidatResult['nilai_total'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach

    <h2 class="text-xl font-bold mb-4">Ranking Kandidat</h2>
<div class="overflow-x-auto">
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">Ranking</th>
                <th class="border border-gray-300 px-4 py-2">Nama Kandidat</th>
                <th class="border border-gray-300 px-4 py-2">Nilai Akhir</th>
                <th class="border border-gray-300 px-4 py-2">Keputusan</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach($rankingKandidat as $index => $item)
                @php
                    $keputusanClass = $index === 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                @endphp
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $item['penilaian']->nama_kandidat }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ number_format($item['hasil']['nilai_akhir'], 2) }}</td>
                    <td class="border border-gray-300 px-4 py-2 {{ $keputusanClass }}">
                        {{ $index === 0 ? 'Diterima' : 'Ditolak' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>
@endsection
