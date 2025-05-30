@extends('layouts.app')

@section('title', 'Tambah Paket')

@section('content')
    <div class="container mx-auto mt-8 px-4">
        <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
            <h1 class="text-3xl font-bold mb-4 text-gray-800">Tambah Paket</h1>

            <!-- Form dengan id "hargaForm" -->
            <form action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data" id="hargaForm">
                @csrf

                <!-- Nama Paket -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="nama_paket">Nama Paket</label>
                    <input type="text" name="nama_paket" id="nama_paket"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <!-- Deskripsi Paket -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="deskripsi_paket">Deskripsi Paket</label>
                    <textarea name="deskripsi_paket" id="deskripsi_paket" rows="4"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <!-- Harga -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="harga">Harga</label>
                    <input type="text" name="harga" id="harga"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <!-- Durasi -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="durasi">Durasi (Hari)</label>
                    <input type="text" name="durasi" id="durasi"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <!-- Destinasi -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="destinasi">Destinasi</label>
                    <input type="text" name="destinasi" id="destinasi"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <!-- Include -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="include">Include</label>
                    <textarea name="include" id="include" rows="3"
                        class="w-full border border-green-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('include') }}</textarea>
                </div>

                <!-- Exclude -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="exclude">Exclude</label>
                    <textarea name="exclude" id="exclude" rows="3"
                        class="w-full border border-red-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">{{ old('exclude') }}</textarea>
                </div>
                <!-- Information Trip -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="information_trip">Informasi Trip</label>
                    <textarea name="information_trip" id="information_trip" rows="4"
                        class="w-full border border-purple-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('information_trip') }}</textarea>
                </div>

                <!-- Itinerary -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="itinerary">Itinerary (Upload PDF) <span
                            class="text-red-500">(Maksimal 10MB)</span></label>
                    <input type="file" name="itinerary" id="itinerary"
                        class="w-full border border-yellow-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <!-- Upload Foto -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="foto">Foto <span
                            class="text-red-500">(Maksimal 2MB)</span></label>
                    <input type="file" name="foto" id="foto"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>


                <!-- Tombol Submit -->
                <div class="flex justify-end space-x-2">
                    <a href="{{ route('paket.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg">
                        Kembali
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Event listener untuk form submit
        document.getElementById('hargaForm').addEventListener('submit', function(e) {
            let hargaInput = document.getElementById('harga');

            // Menghapus simbol "Rp" dan karakter selain angka
            let hargaValue = hargaInput.value.replace(/[^0-9]/g, '');

            // Menetapkan nilai yang sudah dibersihkan ke input
            hargaInput.value = hargaValue;
        });

        // Pemformatan Rupiah pada input
        document.getElementById('harga').addEventListener('input', function(e) {
            let value = e.target.value;

            // Menghapus karakter selain angka
            value = value.replace(/[^0-9]/g, '');

            // Menambahkan pemisah ribuan
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Menambahkan 'Rp' di depan
            e.target.value = 'Rp ' + value;
        });
    </script>
@endsection
