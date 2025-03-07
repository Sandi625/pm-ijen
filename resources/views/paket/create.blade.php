@extends('layouts.app')

@section('title', 'Tambah Paket')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Tambah Paket</h1>

        <form action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Paket -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="nama_paket">Nama Paket</label>
                <input type="text" name="nama_paket" id="nama_paket" class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Deskripsi Paket -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="deskripsi_paket">Deskripsi Paket</label>
                <textarea name="deskripsi_paket" id="deskripsi_paket" rows="4" class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- Harga -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="harga">Harga</label>
                <input type="number" name="harga" id="harga" step="0.01" class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Durasi -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="durasi">Durasi (Hari)</label>
                <input type="number" name="durasi" id="durasi" class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Destinasi -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="destinasi">Destinasi</label>
                <input type="text" name="destinasi" id="destinasi" class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Include & Exclude -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="include_exclude">Include & Exclude</label>
                <textarea name="include_exclude" id="include_exclude" rows="4" class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- Upload Foto -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
                    Simpan Paket
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
