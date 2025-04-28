@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
    <div class="container mx-auto mt-8 px-4">
        <h1 class="text-3xl font-bold mb-4">Daftar Pesanan</h1>

        <table class="table-auto w-full border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">Nama</th>
                    {{-- <th class="px-4 py-2 border-b">Email</th>
                    <th class="px-4 py-2 border-b">Nomor Telepon</th> --}}
                    <th class="px-4 py-2 border-b">Kriteria</th>
                    <th class="px-4 py-2 border-b">Paket</th>
                    <th class="px-4 py-2 border-b">Tanggal Pesan</th>
                    <th class="px-4 py-2 border-b">Tanggal Keberangkatan</th>
                    <th class="px-4 py-2 border-b">Jumlah Peserta</th>
                    <th class="px-4 py-2 border-b">Negara</th>
                    <th class="px-4 py-2 border-b">Bahasa</th>
                    <th class="px-4 py-2 border-b">Riwayat Medis</th>
                    {{-- <th class="px-4 py-2 border-b">Paspor</th> --}}
                    <th class="px-4 py-2 border-b">Special Request</th>
                    {{-- <th class="px-4 py-2 border-b">Aksi</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanans as $pesanan)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $pesanan->nama }}</td>
                        {{-- <td class="px-4 py-2 border-b">{{ $pesanan->email }}</td>
                        <td class="px-4 py-2 border-b">{{ $pesanan->nomor_telp }}</td> --}}
                        <td class="px-4 py-2 border-b">{{ $pesanan->kriteria->nama ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border-b">{{ $pesanan->paket->nama_paket ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border-b">{{ $pesanan->tanggal_pesan }}</td>
                        <td class="px-4 py-2 border-b">{{ $pesanan->tanggal_keberangkatan }}</td>
                        <td class="px-4 py-2 border-b">{{ $pesanan->jumlah_peserta }}</td>
                        <td class="px-4 py-2 border-b">{{ $pesanan->negara }}</td>
                        <td class="px-4 py-2 border-b">{{ $pesanan->bahasa }}</td>
                        <td class="px-4 py-2 border-b">{{ $pesanan->riwayat_medis }}</td>
                        {{-- <td class="px-4 py-2 border-b">
                            @if ($pesanan->paspor)
                                <img src="{{ asset('storage/' . $pesanan->paspor) }}" alt="Paspor" class="w-20 h-20">
                            @else
                                N/A
                            @endif
                        </td> --}}
                        <td class="px-4 py-2 border-b">{{ $pesanan->special_request ?? 'N/A' }}</td>
                        {{-- <td class="px-4 py-2 border-b">
                            <a href="{{ route('pesanan.edit', $pesanan->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a> |
                            <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

