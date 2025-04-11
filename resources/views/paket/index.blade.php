@extends('layouts.base')

@section('title', 'Daftar Paket')

@section('content')
<div class="container-fluid vh-100 d-flex flex-column">
    <div class="bg-white shadow-md rounded-lg p-4 flex-grow-1">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Daftar Paket</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('paket.create') }}" class="btn btn-success mb-4">
            <i class="fa-solid fa-plus"></i> Tambah Paket
        </a>

        <div class="overflow-auto">
            <table class="table table-bordered w-100">
                <thead class="table-light">
                    <tr>
                        <th>NO</th>
                        <th>Nama Paket</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Destinasi</th>
                        <th>Include / Exclude</th>
                        <th>Foto</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pakets as $index => $paket)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $paket->nama_paket }}</td>
                            <td>{{ Str::limit($paket->deskripsi_paket, 50) }}</td>
                            <td>Rp {{ number_format($paket->harga, 2, ',', '.') }}</td>
                            <td>{{ $paket->durasi }} Hari</td>
                            <td>{{ $paket->destinasi }}</td>
                            <td>{{ Str::limit($paket->include_exclude, 50) }}</td>
                            <td>
                                @if($paket->foto)
                                    <img src="{{ asset('storage/' . $paket->foto) }}" alt="Foto Paket" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    Tidak ada foto
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('paket.edit', $paket->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <button onclick="confirmDelete({{ $paket->id }})" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </div>
                                <form id="delete-form-{{ $paket->id }}" action="{{ route('paket.destroy', $paket->id) }}" method="POST" class="d-none">
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
            title: "Apakah Anda yakin?",
            text: "Data ini akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
