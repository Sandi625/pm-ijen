<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan Profile Matching</title>
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: #333;
        }
        h1, h2, h3 {
            color: #2d3748;
            text-align: center;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 26px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        h2 {
            font-size: 22px;
            text-transform: uppercase;
            margin-top: 40px;
            letter-spacing: 1px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        h3 {
            font-size: 18px;
            margin-bottom: 10px;
            text-transform: capitalize;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            border-radius: 5px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #4a5568;
            color: #fff;
            text-transform: uppercase;
            font-weight: bold;
        }
        tbody tr:nth-child(even) {
            background-color: #e2e8f0;
        }
        tbody tr:hover {
            background-color: #cbd5e0;
        }
        .bg-green-100 {
            background-color: #d4edda;
        }
        .bg-red-100 {
            background-color: #f8d7da;
        }
        .text-green-800 {
            color: #155724;
        }
        .text-red-800 {
            color: #721c24;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .header img {
            width: 80px;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 5px 0;
            font-size: 20px;
            color: #1a202c;
            font-weight: normal;
        }
        .header h1 {
            margin: 0;
            font-size: 26px;
            color: #2d3748;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('assets/logo.png') }}" alt="Logo" width="80px">
        <h1>Sistem Pendukung Keputusan Rekrutmen Bidan Metode Profile Matching</h1>
        <br>
        <br>
        <h1 class="text-center">Hasil Perhitungan Profile Matching</h1>
    </div>

    @foreach($hasilPerKriteria as $kriteriaId => $kriteriaData)
        <div>
            <h2>Kriteria: {{ $kriteriaData['nama_kriteria'] }}</h2>

            <h3>Tabel Pembobotan {{ $kriteriaData['nama_kriteria'] }}</h3>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Calon</th>
                        <th>Kriteria</th>
                        @foreach($kriteriaData['subkriterias'] as $index => $subkriteria)
                            <th>K{{ $index + 1 }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($kriteriaData['kandidat_results'] as $index => $kandidatResult)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kandidatResult['nama_kandidat'] }}</td>
                            <td>{{ $kriteriaData['nama_kriteria'] }}</td>
                            @foreach($kriteriaData['subkriterias'] as $subkriteria)
                                @php
                                    $subkriteriaResult = collect($kandidatResult['detail'])->firstWhere('subkriteria_id', $subkriteria->id);
                                @endphp
                                <td>
                                    {{ $subkriteriaResult ? $subkriteriaResult['nilai'] : '-' }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" style="font-weight: bold;">Profil Standar</td>
                        @foreach($kriteriaData['subkriterias'] as $subkriteria)
                            <td>{{ $subkriteria->profil_standar }}</td>
                        @endforeach
                    </tr>
                    @foreach($kriteriaData['kandidat_results'] as $index => $kandidatResult)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kandidatResult['nama_kandidat'] }}</td>
                            <td>{{ $kriteriaData['nama_kriteria'] }}</td>
                            @foreach($kriteriaData['subkriterias'] as $subkriteria)
                                @php
                                    $subkriteriaResult = collect($kandidatResult['detail'])->firstWhere('subkriteria_id', $subkriteria->id);
                                @endphp
                                <td>
                                    {{ $subkriteriaResult ? $subkriteriaResult['gap'] : '-' }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3>Tabel Hasil Bobot {{ $kriteriaData['nama_kriteria'] }}</h3>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Calon</th>
                        <th>Kriteria</th>
                        <th>GAP</th>
                        @foreach($kriteriaData['subkriterias'] as $index => $subkriteria)
                            <th>K{{ $index + 1 }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($kriteriaData['kandidat_results'] as $index => $kandidatResult)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kandidatResult['nama_kandidat'] }}</td>
                            <td>{{ $kriteriaData['nama_kriteria'] }}</td>
                            <td></td>
                            @foreach($kriteriaData['subkriterias'] as $subkriteria)
                                @php
                                    $subkriteriaResult = collect($kandidatResult['detail'])->firstWhere('subkriteria_id', $subkriteria->id);
                                @endphp
                                <td>
                                    {{ $subkriteriaResult ? $subkriteriaResult['bobot_nilai'] : '-' }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

    <h2>Tabel Pengelompokan Nilai Bobot GAP per Kriteria</h2>
    @foreach($hasilPerKriteria as $kriteriaId => $kriteriaData)
        <div>
            <h3>{{ $kriteriaData['nama_kriteria'] }}</h3>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Calon</th>
                        @foreach($kriteriaData['subkriterias'] as $index => $subkriteria)
                            <th>K{{ $index + 1 }}</th>
                        @endforeach
                        <th>Core Factor</th>
                        <th>Secondary Factor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kriteriaData['kandidat_results'] as $index => $kandidatResult)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kandidatResult['nama_kandidat'] }}</td>
                            @foreach($kriteriaData['subkriterias'] as $subkriteria)
                                @php
                                    $subkriteriaResult = collect($kandidatResult['detail'])->firstWhere('subkriteria_id', $subkriteria->id);
                                @endphp
                                <td>
                                    {{ $subkriteriaResult ? $subkriteriaResult['bobot_nilai'] : '-' }}
                                </td>
                            @endforeach
                            <td>{{ number_format($kandidatResult['nilai_cf'], 2) }}</td>
                            <td>{{ number_format($kandidatResult['nilai_sf'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

    <h2>Tabel Perhitungan Nilai Total</h2>
    @foreach($hasilPerKriteria as $kriteriaId => $kriteriaData)
        <div>
            <h3>{{ $kriteriaData['nama_kriteria'] }}</h3>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kandidat</th>
                        <th>Nilai CF</th>
                        <th>Nilai SF</th>
                        <th>Nilai Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kriteriaData['kandidat_results'] as $index => $kandidatResult)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kandidatResult['nama_kandidat'] }}</td>
                            <td>{{ number_format($kandidatResult['nilai_cf'], 2) }}</td>
                            <td>{{ number_format($kandidatResult['nilai_sf'], 2) }}</td>
                            <td>{{ number_format($kandidatResult['nilai_total'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

    <h2>Ranking Kandidat</h2>
    <table>
        <thead>
            <tr>
                <th>Ranking</th>
                <th>Nama Kandidat</th>
                <th>Nilai Akhir</th>
                <th>Keputusan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rankingKandidat as $index => $item)
                @php
                    $keputusan = $index === 0 ? 'Diterima' : 'Ditolak';
                    $keputusanClass = $index === 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                    
                    // Adjust the display for different scenarios
                    if (request()->route()->getName() === 'penilaian.pdf.accepted') {
                        $keputusan = 'Diterima';
                        $keputusanClass = 'bg-green-100 text-green-800';
                    } elseif (request()->route()->getName() === 'penilaian.pdf.rejected') {
                        $keputusan = 'Ditolak';
                        $keputusanClass = 'bg-red-100 text-red-800';
                    }
                @endphp
                <tr class="{{ $keputusanClass }}">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['penilaian']->nama_kandidat }}</td>
                    <td>{{ number_format($item['hasil']['nilai_akhir'], 2) }}</td>
                    <td>{{ $keputusan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table
</body>
</html>
