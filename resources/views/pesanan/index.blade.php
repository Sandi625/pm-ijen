@extends('layouts.base')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="container-fluid vh-100 d-flex flex-column">
    <div class="bg-white shadow-md rounded-lg p-4 flex-grow-1">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Daftar Pesanan</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-auto">
            <table class="table table-bordered w-100">
                <thead class="table-light">
                    <tr>
                        <th>NO</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Nama Guide</th> <!-- Tambahan -->
                        <th>Negara</th>
                        <th>Bahasa</th>
                        <th>Riwayat Medis</th>
                        <th>Special Request</th>
                        <th>Nama Paket</th>
                        <th>Nama Kriteria</th>
                        <th>Tanggal Pesan</th>
                        <th>Tanggal Keberangkatan</th>
                        <th>Jumlah Peserta</th>
                        <th>Paspor</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesanans as $index => $pesanan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pesanan->nama }}</td>
                            <td>{{ $pesanan->email }}</td>
                            <td>{{ $pesanan->nomor_telp }}</td>
                            <td>
                                {{ $pesanan->guide ? $pesanan->guide->nama_guide : '-' }} <!-- Nama Guide -->
                            </td>
                            <td>{{ $pesanan->negara ?? '-' }}</td>
                            <td>{{ $pesanan->bahasa ?? '-' }}</td>
                            <td>{{ $pesanan->riwayat_medis ?? '-' }}</td>
                            <td>{{ $pesanan->special_request ?? '-' }}</td>
                            <td>{{ $pesanan->paket->nama_paket ?? '-' }}</td>
                            <td>{{ $pesanan->kriteria->nama ?? '-' }}</td>

                            <td>{{ $pesanan->tanggal_pesan }}</td>
                            <td>{{ $pesanan->tanggal_keberangkatan }}</td>
                            <td>{{ $pesanan->jumlah_peserta }}</td>
                            <td>
                                @if ($pesanan->paspor)
                                    <a href="{{ asset('storage/' . $pesanan->paspor) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $pesanan->paspor) }}"
                                            alt="Foto Paspor"
                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; box-shadow: 0 0 4px rgba(0,0,0,0.2);">
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('pesanan.edit', $pesanan->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <button onclick="confirmDelete({{ $pesanan->id }})" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </div>
                                <form id="delete-form-{{ $pesanan->id }}" action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
@endsection
