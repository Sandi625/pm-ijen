@extends('layouts.app')

@section('title', 'Daftar Subkriteria')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Daftar Subkriteria</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('subkriteria.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Tambah Subkriteria</a>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Nama</th>
                    <th class="py-2 px-4 border-b">Kriteria</th>
                    <th class="py-2 px-4 border-b">Core Factor</th>
                    <th class="py-2 px-4 border-b">Profil Standar</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($subkriterias as $subkriteria)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $subkriteria->nama }}</td>
                        <td class="py-2 px-4 border-b">{{ $subkriteria->kriteria->nama }}</td>
                        <td class="py-2 px-4 border-b">{{ $subkriteria->is_core_factor ? 'Ya' : 'Tidak' }}</td>
                        <td class="py-2 px-4 border-b">{{ $subkriteria->profil_standar}}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('subkriteria.edit', $subkriteria->id) }}" class="inline-block py-1 px-4 rounded-md bg-blue-500 text-white hover:text-gray-700"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('subkriteria.destroy', $subkriteria->id) }}" method="POST" class="inline">
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
