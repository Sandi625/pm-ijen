@extends('layouts.app')

@section('title', 'Tambah Subkriteria')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Tambah Subkriteria</h1>

        <form action="{{ route('subkriteria.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="kriteria_id" class="block text-gray-700 text-sm font-bold mb-2">Kriteria:</label>
                <select name="kriteria_id" id="kriteria_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($kriterias as $kriteria)
                        <option value="{{ $kriteria->id }}">{{ $kriteria->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Subkriteria:</label>
                <input type="text" name="nama" id="nama" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            

            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>

            <div class="mb-4">
                <label for="is_core_factor" class="block text-gray-700 text-sm font-bold mb-2">Core Factor:</label>
                <input type="checkbox" name="is_core_factor" id="is_core_factor" value="1" class="mr-2 leading-tight">
            </div>

            <div class="mb-4">
                <label for="profil_standar" class="block text-gray-700 text-sm font-bold mb-2">Profil Standar:</label>
                <input type="number" min="1" max="5" name="profil_standar" id="profil_standar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Simpan</button>
                <a href="{{ route('subkriteria.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
