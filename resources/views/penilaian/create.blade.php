<!-- resources/views/penilaian/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Tambah Penilaian</h1>
    <form action="{{ route('penilaian.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nama_kandidat" class="block text-gray-700 text-sm font-bold mb-2">Nama Kandidat</label>
            <input type="text" name="nama_kandidat" id="nama_kandidat" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        
        @foreach($kriterias as $kriteria)
            <h2 class="text-xl font-bold mt-4 mb-2">{{ $kriteria->nama }}</h2>
            @foreach($kriteria->subkriterias as $subkriteria)
                <div class="mb-4">
                    <label for="nilai_{{ $subkriteria->id }}" class="block text-gray-700 text-sm font-bold mb-2">{{ $subkriteria->nama }}</label>
                    <p><pre>{{ $subkriteria-> deskripsi }}</pre></p>
                    <select name="nilai[{{ $subkriteria->id }}]" id="nilai_{{ $subkriteria->id }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-3" required>
                        @for($i = 1; $i <= 4; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            @endforeach
        @endforeach
        
        <div class="flex items-center justify-between mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan Penilaian
            </button>
        </div>
    </form>
</div>
@endsection