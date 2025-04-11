@extends('layouts.app')

@section('title', 'Edit Paket')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Edit Paket</h1>

        <form action="{{ route('paket.update', $paket->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama Paket -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="nama_paket">Nama Paket</label>
                <input type="text" name="nama_paket" id="nama_paket" value="{{ old('nama_paket', $paket->nama_paket) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nama_paket') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Deskripsi Paket -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="deskripsi_paket">Deskripsi</label>
                <textarea name="deskripsi_paket" id="deskripsi_paket" rows="4"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('deskripsi_paket', $paket->deskripsi_paket) }}</textarea>
                @error('deskripsi_paket') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Harga -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="harga">Harga</label>
                <input type="number" name="harga" id="harga" step="0.01" value="{{ old('harga', $paket->harga) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('harga') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Durasi -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="durasi">Durasi (hari)</label>
                <input type="number" name="durasi" id="durasi" value="{{ old('durasi', $paket->durasi) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('durasi') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Destinasi -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="destinasi">Destinasi</label>
                <input type="text" name="destinasi" id="destinasi" value="{{ old('destinasi', $paket->destinasi) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('destinasi') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Include & Exclude -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="include_exclude">Include & Exclude</label>
                <textarea name="include_exclude" id="include_exclude" rows="3"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('include_exclude', $paket->include_exclude) }}</textarea>
                @error('include_exclude') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Foto -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="foto">Foto</label>
                <input type="file" name="foto" id="foto"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('foto') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                <!-- Tampilkan foto lama jika ada -->
                @if ($paket->foto)
                    <div class="mt-2">
                        <p class="text-gray-700 text-sm">Foto saat ini:</p>
                        <img src="{{ asset('storage/' . $paket->foto) }}" alt="Foto Paket" class="w-32 h-32 object-cover rounded-lg mt-1">
                    </div>
                @endif
            </div>

            <!-- Tombol Simpan -->
            <div class="flex justify-end space-x-2">
                <a href="{{ route('paket.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg">
                    Kembali
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Simpan Perubahan
                </button>
            </div>


        </form>
    </div>
</div>
@endsection
