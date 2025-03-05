@extends('layouts.app')

@section('title', 'Daftar Kriteria')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Daftar Kriteria</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('kriteria.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Tambah Kriteria</a>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Kode</th>
                    <th class="py-2 px-4 border-b">Nama</th>
                    <th class="py-2 px-4 border-b">Deskripsi</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                
                @foreach($kriterias as $kriteria)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $kriteria->kode }}</td>
                        <td class="py-2 px-4 border-b">{{ $kriteria->nama }}</td>
                        <td class="py-2 px-4 border-b">{{ $kriteria->deskripsi }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('kriteria.edit', $kriteria) }}" class="inline-block py-1 px-4 rounded-md bg-blue-500 text-white hover:text-gray-700"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class=" inline-block py-1 px-2 rounded-md bg-red-500 text-white hover:text-black" onclick="return confirm('Apakah Anda yakin ingin menghapus penilaian ini?')"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
