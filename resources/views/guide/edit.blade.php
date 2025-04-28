@extends('layouts.app')

@section('title', 'Edit Kriteria')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Edit Guide</h1>

        <form action="{{ route('guide.update', ['guide' => $guide->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div>
                <label for="nama_guide" class="block font-semibold">Nama Guide:</label>
                <input type="text" id="nama_guide" name="nama_guide" value="{{ old('nama_guide', $guide->nama_guide) }}" required class="w-full border rounded p-2">
                @error('nama_guide') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="salary" class="block font-semibold">Gaji:</label>
                <input type="number" id="salary" name="salary" value="{{ old('salary', $guide->salary) }}" required class="w-full border rounded p-2">
                @error('salary') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="deskripsi_guide" class="block font-semibold">Deskripsi:</label>
                <textarea id="deskripsi_guide" name="deskripsi_guide" class="w-full border rounded p-2">{{ old('deskripsi_guide', $guide->deskripsi_guide) }}</textarea>
                @error('deskripsi_guide') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="nomer_hp" class="block font-semibold">Nomor HP:</label>
                <input type="text" id="nomer_hp" name="nomer_hp" value="{{ old('nomer_hp', $guide->nomer_hp) }}" required class="w-full border rounded p-2">
                @error('nomer_hp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="alamat" class="block font-semibold">Alamat:</label>
                <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $guide->alamat) }}" required class="w-full border rounded p-2">
                @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="block font-semibold">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $guide->email) }}" required class="w-full border rounded p-2">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="bahasa" class="block font-semibold">Bahasa:</label>
                <input type="text" id="bahasa" name="bahasa" value="{{ old('bahasa', $guide->bahasa) }}" class="w-full border rounded p-2">
                @error('bahasa') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="foto" class="block font-semibold">Foto:</label>
                <input type="file" id="foto" name="foto" accept="image/*" class="w-full border rounded p-2">
                @error('foto') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                @if(!empty($guide->foto))
                    <div class="mt-2">
                        <p class="text-sm">Foto Lama:</p>
                        <img src="{{ asset('storage/' . $guide->foto) }}" alt="Foto Guide" class="w-24 h-24 object-cover rounded">
                    </div>
                @endif
            </div>

            <div>
                <label for="status" class="block font-semibold">Status:</label>
                <select id="status" name="status" required class="w-full border rounded p-2">
                    <option value="1" {{ old('status', $guide->status) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="2" {{ old('status', $guide->status) == 2 ? 'selected' : '' }}>Sedang Guiding</option>
                    <option value="3" {{ old('status', $guide->status) == 3 ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>


            <div class="flex justify-between">
                <a href="{{ route('guide.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Kembali</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Simpan Perubahan</button>
            </div>
        </form>



    </div>
</div>
@endsection
