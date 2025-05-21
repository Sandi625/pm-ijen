@extends('layouts.base')

@section('title', 'Detail Guide')

@section('content')
<div class="container py-4">
    <div class="bg-white shadow rounded p-4">
        <h2 class="text-center mb-4">Detail Guide</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Detail</th>
                    <th>Informasi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nama Guide</td>
                    <td>{{ $guide->nama_guide }}</td>
                </tr>
                <tr>
                    <td>Salary</td>
                    <td>Rp {{ number_format($guide->salary, 0, ',', '.') }}</td>
                </tr>
                <tr>
    <td>Kriteria Unggulan</td>
    <td>{{ $guide->kriteria_unggulan_nama ?? '-' }}</td>
</tr>

                <tr>
                    <td>Deskripsi</td>
                    <td>{{ $guide->deskripsi_guide ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Nomor HP</td>
                    <td>{{ $guide->nomer_hp }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        @switch($guide->status)
                            @case('aktif')
                                <span class="text-success">Aktif</span>
                                @break
                            @case('sedang_guiding')
                                <span class="text-warning">Sedang Guiding</span>
                                @break
                            @case('tidak_aktif')
                                <span class="text-danger">Tidak Aktif</span>
                                @break
                            @default
                                <span>-</span>
                        @endswitch
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>{{ $guide->alamat ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $guide->email }}</td>
                </tr>
                <tr>
                    <td>Bahasa</td>
                    <td>{{ $guide->bahasa }}</td>
                </tr>
                <tr>
                    <td>Foto</td>
                    <td>
                        @if($guide->foto)
                            <img src="{{ asset('storage/' . $guide->foto) }}" alt="Foto {{ $guide->nama_guide }}" style="max-width: 150px; max-height: 150px;">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="{{ route('guide.index') }}" class="btn btn-secondary">Kembali ke Daftar Guide</a>
        </div>
    </div>
</div>
@endsection
