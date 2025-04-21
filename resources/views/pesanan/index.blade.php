@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Daftar Pesanan</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('pesanan.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Tambah Pesanan</a>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border-b">NO</th>
                    <th class="py-2 px-4 border-b">Nama</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Nomor Telepon</th>
                    <th class="py-2 px-4 border-b">Negara</th> <!-- Kolom baru -->
                    <th class="py-2 px-4 border-b">Bahasa</th> <!-- Kolom baru -->
                    <th class="py-2 px-4 border-b">Riwayat Medis</th> <!-- Kolom baru -->
                    <th class="py-2 px-4 border-b">Nama Paket</th>
                    <th class="py-2 px-4 border-b">Nama Kriteria</th>
                    <th class="py-2 px-4 border-b">Tanggal Pesan</th>
                    <th class="py-2 px-4 border-b">Tanggal Keberangkatan</th>
                    <th class="py-2 px-4 border-b">Jumlah Peserta</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($pesanans as $index => $pesanan)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                    <td class="py-2 px-4 border-b">{{ $pesanan->nama }}</td>
                    <td class="py-2 px-4 border-b">{{ $pesanan->email }}</td>
                    <td class="py-2 px-4 border-b">{{ $pesanan->nomor_telp }}</td>
                    <td class="py-2 px-4 border-b">{{ $pesanan->negara ?? '-' }}</td>
                    <td class="py-2 px-4 border-b">{{ $pesanan->bahasa ?? '-' }}</td>
                    <td class="py-2 px-4 border-b">{{ $pesanan->riwayat_medis ?? '-' }}</td>
                    <td class="py-2 px-4 border-b">{{ $pesanan->paket->nama_paket ?? '-' }}</td>
                    <td class="py-2 px-4 border-b">{{ $pesanan->kriteria->nama ?? '-' }}</td>
                    <td class="py-2 px-4 border-b">{{ $pesanan->tanggal_pesan }}</td>
                    <td class="py-2 px-4 border-b">{{ $pesanan->tanggal_keberangkatan }}</td>
                    <td class="py-2 px-4 border-b">{{ $pesanan->jumlah_peserta }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('pesanan.edit', $pesanan->id) }}" class="text-blue-500">Edit</a> |
                        <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

