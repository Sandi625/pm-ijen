@extends('layouts.app')

@section('title', 'Tambah Galeri')

@section('content')
<div class="container-fluid min-vh-100 d-flex flex-column">
    <div class="bg-white shadow-md rounded-lg p-6 flex-grow-1 d-flex flex-column ml-6">
        <h1 class="text-4xl font-bold mb-6 text-gray-800">Tambah Galeri</h1>

        <form action="{{ route('galeris.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Judul Input -->
            <div class="mb-4">
                <label for="judul" class="block text-lg font-medium text-gray-700">Judul</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul') }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukkan judul galeri" required>
                @error('judul')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Deskripsi Input -->
            <div class="mb-4">
                <label for="deskripsi" class="block text-lg font-medium text-gray-700">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukkan deskripsi galeri">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

             <!-- Message to guide user -->
             <div class="mb-4 text-base text-red-500">
                <p class="italic">Pilih dan upload salah satu di bawah ini, jangan upload semua file sekaligus.</p>
            </div>

            <div class="mb-4">
                <label for="videolokal" class="block text-lg font-medium text-gray-700">Video Lokal (Opsional)
                    <span class="text-red-500">(Maksimal 50MB)</span>
                </label>
                <input type="file" id="videolokal" name="videolokal" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('videolokal')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Video YouTube URL -->
            <div class="mb-4">
                <label for="videoyoutube" class="block text-lg font-medium text-gray-700">URL Video YouTube (Opsional)</label>
                <input type="url" id="videoyoutube" name="videoyoutube" value="{{ old('videoyoutube') }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukkan URL video YouTube">
                @error('videoyoutube')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Foto Upload -->
            <div class="mb-4">
                <label for="foto" class="block text-lg font-medium text-gray-700">Foto (Opsional)
                    <span class="text-red-500">(Maksimal 2MB)</span>
                </label>
                <input type="file" id="foto" name="foto" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('foto')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>






            <!-- Submit Button -->
            <div class="flex justify-between items-center mt-8">
                <a href="{{ route('galeris.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Kembali</a>


                <button type="submit" class="bg-blue-500 text-white px-8 py-3 rounded-md hover:bg-blue-600 transition duration-200 text-xl">
                    Tambah Galeri
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
