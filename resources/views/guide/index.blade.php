@extends('layouts.app')

@section('title', 'Daftar Kriteria')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Daftar Guide</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('guide.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Tambah Guide</a>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">NO</th>
                    <th class="py-2 px-4 border-b">Nama Guide</th>
                    <th class="py-2 px-4 border-b">Salary</th>
                    <th class="py-2 px-4 border-b">Kriteria</th>
                    <th class="py-2 px-4 border-b">Deskripsi</th>
                    <th class="py-2 px-4 border-b">Nomor HP</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Alamat</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Bahasa</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($guides as $index => $guide)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                        <td class="py-2 px-4 border-b">{{ $guide->nama_guide }}</td>
                        <td class="py-2 px-4 border-b">Rp {{ number_format($guide->salary, 2, ',', '.') }}</td>
                        <td class="py-2 px-4 border-b">{{ $guide->kriteria->nama_kriteria ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $guide->deskripsi_guide ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $guide->nomer_hp }}</td>
                        <td class="py-2 px-4 border-b">
                            <span class="{{ $guide->status ? 'text-green-500' : 'text-red-500' }}">
                                {{ $guide->status ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border-b">{{ $guide->alamat ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $guide->email }}</td>
                        <td class="py-2 px-4 border-b">{{ $guide->bahasa }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('guide.edit', $guide->id) }}" class="text-blue-500">Edit</a> |
                            <form action="{{ route('guide.destroy', $guide->id) }}" method="POST" class="inline">
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
