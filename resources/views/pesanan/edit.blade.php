@extends('layouts.app')

@section('title', 'Edit Pesanan')

@section('content')
    <div class="container mx-auto mt-8 px-4">
        <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
            <h1 class="text-3xl font-bold mb-4 text-gray-800">Edit Pesanan</h1>

            <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Order ID -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="order_id">Order ID</label>
                    <input type="text" name="order_id" id="order_id" value="{{ old('order_id', $pesanan->order_id) }}"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <p class="text-sm text-gray-500 mt-1">Contoh format: ORDER20240516XXXX</p>
                </div>


                <!-- Nama -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $pesanan->nama) }}"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $pesanan->email) }}"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <!-- Nomor Telepon -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="nomor_telp">Nomor Telepon</label>
                    <input type="text" name="nomor_telp" id="nomor_telp"
                        value="{{ old('nomor_telp', $pesanan->nomor_telp) }}"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <!-- Kriteria -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="id_kriteria">Kriteria</label>
                    <select name="id_kriteria" id="id_kriteria"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                        @foreach ($kriterias as $kriteria)
                            <option value="{{ $kriteria->id }}"
                                {{ $pesanan->id_kriteria == $kriteria->id ? 'selected' : '' }}>
                                {{ $kriteria->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Paket -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="id_paket">Paket</label>
                    <select name="id_paket" id="id_paket"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                        @foreach ($pakets as $paket)
                            <option value="{{ $paket->id }}" {{ $pesanan->id_paket == $paket->id ? 'selected' : '' }}>
                                {{ $paket->nama_paket }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Pesan -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="tanggal_pesan">Tanggal Pesan</label>
                    <input type="date" name="tanggal_pesan" id="tanggal_pesan"
                        value="{{ old('tanggal_pesan', $pesanan->tanggal_pesan) }}"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <!-- Tanggal Keberangkatan -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="tanggal_keberangkatan">Tanggal
                        Keberangkatan</label>
                    <input type="date" name="tanggal_keberangkatan" id="tanggal_keberangkatan"
                        value="{{ old('tanggal_keberangkatan', $pesanan->tanggal_keberangkatan) }}"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <!-- Jumlah Peserta -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="jumlah_peserta">Jumlah Peserta</label>
                    <input type="number" name="jumlah_peserta" id="jumlah_peserta"
                        value="{{ old('jumlah_peserta', $pesanan->jumlah_peserta) }}"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <!-- Negara -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="negara">Negara</label>
                    <input type="text" name="negara" id="negara" value="{{ old('negara', $pesanan->negara) }}"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Bahasa -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="bahasa">Bahasa</label>
                    <input type="text" name="bahasa" id="bahasa" value="{{ old('bahasa', $pesanan->bahasa) }}"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Riwayat Medis -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="riwayat_medis">Riwayat Medis</label>
                    <textarea name="riwayat_medis" id="riwayat_medis"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        rows="4">{{ old('riwayat_medis', $pesanan->riwayat_medis) }}</textarea>
                </div>

                <!-- Upload Paspor -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="paspor">Upload Paspor</label>
                    @if ($pesanan->paspor)
                        <p class="mb-2">Paspor saat ini:</p>
                        <img src="{{ asset('storage/' . $pesanan->paspor) }}" alt="Paspor"
                            class="mb-2 w-40 rounded shadow">
                    @endif
                    <input type="file" name="paspor" id="paspor" accept="image/*"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Special Request -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="special_request">Permintaan Khusus</label>
                    <textarea name="special_request" id="special_request"
                        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        rows="4">{{ old('special_request', $pesanan->special_request) }}</textarea>
                </div>
                <div class="mb-3">
                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
                        <select name="status" id="status"
                            class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="1" {{ old('status', $pesanan->status) == 1 ? 'selected' : '' }}>Aktif
                            </option>
                            <option value="0" {{ old('status', $pesanan->status) == 0 ? 'selected' : '' }}>Tidak
                                Aktif</option>
                        </select>
                    </div>


                </div>

               <div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2" for="id_guide">Guide</label>
    <select name="id_guide" id="id_guide"
        class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">-- Pilih Guide --</option>
       @foreach ($guides as $guide)
    <option value="{{ $guide->id }}" {{ $pesanan->id_guide == $guide->id ? 'selected' : '' }}>
        {{ $guide->nama_guide }}
        - {{ $guide->kriteria_unggulan_nama ?? 'Tidak Diketahui' }}
    </option>
@endforeach

    </select>
</div>















                <!-- Tombol Submit -->
                <div class="flex justify-between items-center">
                    <a href="{{ route('pesanan.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        Kembali
                    </a>

                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
                        Perbarui Pesanan
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: {!! json_encode(session('success')) !!},
                confirmButtonColor: '#3085d6',
            });
        </script>
    @endif




@endsection
