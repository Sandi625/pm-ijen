@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 20px;
        }

        .custom-container {
            max-width: 1200px;
            margin: auto;
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-heading {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
            vertical-align: top;
            word-wrap: break-word;
            white-space: pre-wrap;
            font-size: 14px;
        }

        th {
            background-color: #f0f0f0;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .action-link {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .action-link:hover {
            text-decoration: underline;
        }
        .btn {
    display: inline-block;
    padding: 10px 20px;
    text-align: center;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
}

.btn-blue {
    background-color: #007bff;
    color: white;
    border: none;
}

.btn-blue:hover {
    background-color: #0056b3;
}

    </style>

    <div class="custom-container">
        <h1 class="custom-heading">Daftar Pesanan</h1>

        <!-- Menambahkan pesan dengan warna merah -->
        <p style="color: red; text-align: center; font-size: 16px; margin-bottom: 20px;">
            Klik detail untuk melihat spesial request dan riwayat medis pelanggan
        </p>

        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kriteria</th>
                        <th>Paket</th>
                        <th>Tanggal Pesan</th>
                        <th>Tanggal Keberangkatan</th>
                        <th>Jumlah Peserta</th>
                        <th>Negara</th>
                        <th>Bahasa</th>
                        <th>Riwayat Medis</th>
                        <th>Special Request</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesanans as $pesanan)
                        <tr>
                            <td>{{ $pesanan->nama }}</td>
                            <td>{{ $pesanan->kriteria->nama ?? 'N/A' }}</td>
                            <td>{{ $pesanan->paket->nama_paket ?? 'N/A' }}</td>
                            <td>{{ $pesanan->tanggal_pesan }}</td>
                            <td>{{ $pesanan->tanggal_keberangkatan }}</td>
                            <td>{{ $pesanan->jumlah_peserta }}</td>
                            <td>{{ $pesanan->negara }}</td>
                            <td>{{ $pesanan->bahasa }}</td>
                            <td>{{ Str::limit($pesanan->riwayat_medis ?? '-', 40) }}</td>
                            <td>{{ Str::limit($pesanan->special_request ?? '-', 40) }}</td>
                            <td>
                                <a href="{{ route('halamanguide.show', $pesanan->id) }}"
                                    class="action-link btn btn-blue">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
