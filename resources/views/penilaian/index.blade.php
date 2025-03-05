<!-- resources/views/penilaian/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Daftar Penilaian</h1>
    
    <a href="{{ route('penilaian.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Tambah Penilaian</a>

    <a href="{{ route('penilaian.all') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Lihat keseluruhan penilaian</a>
    <a href="{{ route('candidates.report') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Cetak Pelamar</a>
    
    
    <table class="mt-4 w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Nama Kandidat</th>
                <th class="border border-gray-300 px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach($penilaians as $penilaian)
            <tr>
    <td class="border border-gray-300 px-4 py-2">{{ $penilaian->nama_kandidat }}</td>
    <td class="border border-gray-300 px-4 py-2">
        <a href="{{ route('penilaian.show', $penilaian) }}" class="inline-block py-1 px-4 rounded-md bg-green-500 text-white hover:text-gray-700">
            <i class="fa-solid fa-eye"></i>
        </a>
        <a href="{{ route('penilaian.edit', $penilaian) }}" class="inline-block py-1 px-4 rounded-md bg-blue-500 text-white hover:text-gray-700 ml-2">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <form action="{{ route('penilaian.destroy', $penilaian) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-block py-1 px-2 rounded-md bg-red-500 text-white hover:text-black ml-2" onclick="return confirm('Apakah Anda yakin ingin menghapus penilaian ini?')">
                <i class="fa-solid fa-trash"></i>
            </button>
        </form>
    </td>
</tr>

            @endforeach
        </tbody>
    </table>
</div>
@endsection