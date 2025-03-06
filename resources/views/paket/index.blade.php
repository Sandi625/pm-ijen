@extends('layouts.app')

@section('title', 'Daftar Paket')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Daftar Paket</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('paket.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Tambah Paket</a>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border-b">NO</th>
                    <th class="py-2 px-4 border-b">Nama Paket</th>
                    <th class="py-2 px-4 border-b">Deskripsi</th>
                    <th class="py-2 px-4 border-b">Harga</th>
                    <th class="py-2 px-4 border-b">Durasi</th>
                    <th class="py-2 px-4 border-b">Destinasi</th>
                    <th class="py-2 px-4 border-b">Include / Exclude</th>
                    <th class="py-2 px-4 border-b">Foto</th>
                    {{-- <th class="py-2 px-4 border-b">Dibuat</th>
                    <th class="py-2 px-4 border-b">Diperbarui</th> --}}
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($pakets as $index => $paket)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                        <td class="py-2 px-4 border-b">{{ $paket->nama_paket }}</td>
                        <td class="py-2 px-4 border-b">{{ Str::limit($paket->deskripsi_paket, 50) }}</td>
                        <td class="py-2 px-4 border-b">Rp {{ number_format($paket->harga, 2, ',', '.') }}</td>
                        <td class="py-2 px-4 border-b">{{ $paket->durasi }} Hari</td>
                        <td class="py-2 px-4 border-b">{{ $paket->destinasi }}</td>
                        <td class="py-2 px-4 border-b">{{ Str::limit($paket->include_exclude, 50) }}</td>
                        <td class="py-2 px-4 border-b">
                            @if($paket->foto)
                                <img src="{{ asset('storage/' . $paket->foto) }}" alt="Foto Paket" class="w-16 h-16 object-cover rounded">
                            @else
                                Tidak ada foto
                            @endif
                        </td>
                        {{-- <td class="py-2 px-4 border-b">{{ $paket->created_at ? $paket->created_at->format('d M Y') : '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $paket->updated_at ? $paket->updated_at->format('d M Y') : '-' }}</td> --}}
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('paket.edit', $paket->id) }}" class="text-blue-500">Edit</a> |
                            <form action="{{ route('paket.destroy', $paket->id) }}" method="POST" class="inline">
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
