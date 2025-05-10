@extends('layouts.base')

@section('title', 'Detail Paket')

@section('content')
    <div class="container py-4">
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-center mb-4">Detail Paket</h2>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Detail</th>
                        <th>Informasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nama Paket</td>
                        <td>{{ $paket->nama_paket }}</td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>{{ $paket->deskripsi_paket ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>Rp {{ number_format($paket->harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Durasi</td>
                        <td>{{ $paket->durasi }}</td>
                    </tr>
                    <tr>
                        <td>Destinasi</td>
                        <td>{{ $paket->destinasi }}</td>
                    </tr>
                    <tr>
                        <td>Include</td>
                        <td>{{ $paket->include ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Exclude</td>
                        <td>{{ $paket->exclude ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Informasi Trip</td>
                        <td>{{ $paket->information_trip ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Itinerary</td>
                        <td>
                            @if ($paket->itinerary)
                                <a href="{{ asset('storage/' . $paket->itinerary) }}" target="_blank" class="text-blue-600 underline">Lihat Itinerary</a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Foto</td>
                        <td>
                            @if ($paket->foto)
                                <img src="{{ asset('storage/' . $paket->foto) }}" alt="Foto Paket" style="max-width: 150px; max-height: 150px;">
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="text-center mt-4">
                <a href="{{ route('paket.index') }}" class="btn btn-secondary">Kembali ke Daftar Paket</a>
            </div>
        </div>
    </div>
@endsection
