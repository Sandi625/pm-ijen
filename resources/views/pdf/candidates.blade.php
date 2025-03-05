<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kandidat Bidan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
        }
        .header img {
            width: 60px;
            margin-right: 20px;
        }
        .header-text {
            flex-grow: 1;
        }
        .header-text h1 {
            margin: 0;
            font-size: 22px;
            color: #333;
            font-weight: bold;
        }
        .header-text h2 {
            margin: 5px 0 0;
            font-size: 18px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 14px;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .signature-line {
            display: inline-block;
            width: 200px;
            border-top: 1px solid #333;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('assets/logo.png') }}" alt="Logo" style="width:150px;height:150px">
            <div class="header-text">
                <h1>Sistem Pendukung Keputusan Rekrutmen Bidan</h1>
                <h2>Metode Profile Matching</h2>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kandidat</th>
                    <th>Nilai Profile Matching</th>
                    <th>Ranking</th>
                </tr>
            </thead>
            <tbody>
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

        <div class="footer">
            <p>Depok, {{ now()->locale('id')->isoFormat('dddd D MMMM Y') }}</p>
            <p>Ttd,</p>
            <div class="signature-line"></div>
        </div>
    </div>
</body>
</html>