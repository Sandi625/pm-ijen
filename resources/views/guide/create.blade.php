@extends('layouts.app')

@section('title', 'Tambah Guide')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Tambah Guide</h1>

        <form action="{{ route('guide.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Guide -->
            <div class="mb-4">
                <label for="nama_guide" class="block text-gray-700 text-sm font-bold mb-2">Nama Guide</label>
                <input type="text" id="nama_guide" name="nama_guide" value="{{ old('nama_guide') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_guide') border-red-500 @enderror">
                @error('nama_guide')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

           <div class="mb-4">
    <label for="salary" class="block text-gray-700 text-sm font-bold mb-2">Salary</label>
    <input
        type="text"
        id="salary"
        name="salary"
        value="{{ old('salary') }}"
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('salary') border-red-500 @enderror"
        oninput="formatRupiah(this)"
        autocomplete="off"
        placeholder="Rp 0"
    >
    @error('salary')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>



<!-- Kriteria (Readonly) -->
{{-- <div class="mb-4">
    <label for="kriteria_id" class="block text-gray-700 text-sm font-bold mb-2">Kriteria</label>
    <select id="kriteria_id" name="kriteria_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" disabled>
        <option value="">Pilih Kriteria</option>
        @foreach($kriterias as $kriteria)
        <option value="{{ $kriteria->id }}" {{ old('kriteria_id') == $kriteria->id ? 'selected' : '' }}>{{ $kriteria->nama_kriteria }}</option>
        @endforeach
    </select>
</div> --}}

<!-- Deskripsi -->
<div class="mb-4">
                <label for="deskripsi_guide" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                <textarea id="deskripsi_guide" name="deskripsi_guide" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('deskripsi_guide') border-red-500 @enderror">{{ old('deskripsi_guide') }}</textarea>
                @error('deskripsi_guide')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nomor HP -->
            <div class="mb-4">
                <label for="nomer_hp" class="block text-gray-700 text-sm font-bold mb-2">Nomor HP</label>
                <input type="text" id="nomer_hp" name="nomer_hp" value="{{ old('nomer_hp') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nomer_hp') border-red-500 @enderror">
                @error('nomer_hp')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Alamat -->
            <div class="mb-4">
                <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
                <textarea id="alamat" name="alamat" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('alamat') border-red-500 @enderror">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bahasa -->
            <div class="mb-4">
                <label for="bahasa" class="block text-gray-700 text-sm font-bold mb-2">Bahasa</label>
                <input type="text" id="bahasa" name="bahasa" value="{{ old('bahasa') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('bahasa') border-red-500 @enderror">
                @error('bahasa')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Foto -->
            <div class="mb-4">
                <label for="foto" class="block text-gray-700 text-sm font-bold mb-2 inline-block">
                    Foto
                    <span class="text-red-500">(Maksimal 2MB)</span> <!-- Menambahkan teks maksimal ukuran file di samping label dengan warna merah -->
                </label>
                <input type="file" id="foto" name="foto" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('foto') border-red-500 @enderror">
                @error('foto')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>





            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                <select id="status" name="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="1" {{ old('status', $guide->status ?? 1) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="2" {{ old('status', $guide->status ?? 1) == 2 ? 'selected' : '' }}>Sedang Guiding</option>
                    <option value="3" {{ old('status', $guide->status ?? 1) == 3 ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>


            <!-- Tombol Simpan -->
            <div class="flex items-center justify-between">
                <a href="{{ route('guide.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Kembali</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Simpan</button>

            </div>





        </form>

    </div>
</div>
                <script>
                    function formatRupiah(input) {
                        // Ambil input, hapus semua kecuali digit dan koma
                        let value = input.value.replace(/[^,\d]/g, '').toString();

                        let split = value.split(',');
                        let part1 = split[0];
                        let part2 = split.length > 1 ? ',' + split[1] : '';

                        // Format ribuan dengan titik
                        part1 = part1.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                        input.value = 'Rp ' + part1 + part2;
                    }

                    // Saat form disubmit, bersihkan input salary menjadi angka murni
                    document.querySelector('form').addEventListener('submit', function(event) {
                        var salaryInput = document.getElementById('salary');
                        var value = salaryInput.value.replace(/[^0-9]/g, ''); // Hanya angka
                        salaryInput.value = value;
                    });

                    // Jika ingin langsung format saat page load dan old value ada
                    window.addEventListener('load', function() {
                        var salaryInput = document.getElementById('salary');
                        if (salaryInput.value) {
                            // Pastikan format Rupiah saat load
                            formatRupiah(salaryInput);
                        }
                    });
                </script>



@endsection
