<!-- resources/views/penilaian/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Edit Penilaian: {{ $penilaian->guide->nama_guide }}</h1>

    <form action="{{ route('penilaian.update', $penilaian->id) }}" method="POST">
        @csrf
        @method('PUT')

        @foreach($kriterias as $kriteria)
            <h2 class="text-xl font-bold mt-4 mb-2">{{ $kriteria->nama }}</h2>
            @foreach($kriteria->subkriterias as $subkriteria)
                <div class="mb-4">
                    <label for="nilai_{{ $subkriteria->id }}" class="block text-gray-700 text-sm font-bold mb-2">{{ $subkriteria->nama }}</label>
                    <p><pre>{{ $subkriteria->deskripsi }}</pre></p>

                    @php
                        $detail = $penilaian->detailPenilaians->where('subkriteria_id', $subkriteria->id)->first();
                    @endphp

                    <select name="nilai[{{ $subkriteria->id }}]" id="nilai_{{ $subkriteria->id }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        @for($i = 1; $i <= 4; $i++)
                            <option value="{{ $i }}" {{ $detail?->nilai == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            @endforeach
        @endforeach

        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('penilaian.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Kembali</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Penilaian
            </button>
        </div>
    </form>
</div>
@endsection
