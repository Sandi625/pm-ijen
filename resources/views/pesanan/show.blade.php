@extends('layouts.base')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="container py-4">
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-center mb-4">Detail Pesanan</h2>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Detail</th>
                        <th>Informasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Order ID</td>
                        <td>{{ $pesanan->order_id }}</td>
                    </tr>

                    <tr>
                        <td>Nama</td>
                        <td>{{ $pesanan->nama }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $pesanan->email }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon</td>
                        <td>{{ $pesanan->nomor_telp }}</td>
                    </tr>
                    <tr>
                        <td>Nama Guide</td>
                        <td>{{ $pesanan->guide->nama_guide ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Negara</td>
                        <td>{{ $pesanan->negara ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Bahasa</td>
                        <td>{{ $pesanan->bahasa ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Riwayat Medis</td>
                        <td>{{ $pesanan->riwayat_medis ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Special Request</td>
                        <td>{{ $pesanan->special_request ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Nama Paket</td>
                        <td>{{ $pesanan->paket->nama_paket ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Nama Kriteria</td>
                        <td>
                            @if($pesanan->detailPesanans->count())
                                {{ $pesanan->detailPesanans->pluck('kriteria.nama')->filter()->implode(', ') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Pesan</td>
                        <td>{{ $pesanan->tanggal_pesan }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Keberangkatan</td>
                        <td>{{ $pesanan->tanggal_keberangkatan }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Peserta</td>
                        <td>{{ $pesanan->jumlah_peserta }}</td>
                    </tr>
                    <tr>
                        <td>Paspor</td>
                        <td>
                            @if ($pesanan->paspor)
                                <a href="{{ asset('storage/' . $pesanan->paspor) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $pesanan->paspor) }}" alt="Paspor"
                                        style="max-width: 100px; max-height: 100px;">
                                </a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="text-center mt-4">
                <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
            </div>
        </div>
    </div>
@endsection
