@extends('layouts.base')

@section('title', 'Daftar Guide')

@section('content')
<div class="container-fluid min-vh-100 d-flex flex-column">
    <div class="bg-white shadow-md rounded-lg p-4 flex-grow-1 d-flex flex-column">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Daftar Guide</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="text-start mb-4">
            <a href="{{ route('guide.create') }}" class="btn btn-success">
                <i class="fa-solid fa-plus"></i> Tambah Guide
            </a>
        </div>

        <div class="overflow-auto flex-grow-1">
            <table class="table table-bordered w-100">
                <thead class="table-light">
                    <tr>
                        <th>NO</th>
                        <th>Nama Guide</th>
                        <th>Salary</th>
                        <th>Kriteria</th>
                        <th>Deskripsi</th>
                        <th>Nomor HP</th>
                        <th>Status</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Bahasa</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guides as $index => $guide)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $guide->nama_guide }}</td>
                            <td>Rp {{ number_format($guide->salary, 2, ',', '.') }}</td>
                            <td>{{ $guide->kriteria->nama_kriteria ?? '-' }}</td>
                            <td>{{ $guide->deskripsi_guide ?? '-' }}</td>
                            <td>{{ $guide->nomer_hp }}</td>
                            <td>
                                <span class="{{ $guide->status ? 'text-success' : 'text-danger' }}">
                                    {{ $guide->status ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>{{ $guide->alamat ?? '-' }}</td>
                            <td>{{ $guide->email }}</td>
                            <td>{{ $guide->bahasa }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('guide.edit', $guide->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <button onclick="confirmDelete({{ $guide->id }})" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </div>
                                <form id="delete-form-{{ $guide->id }}" action="{{ route('guide.destroy', $guide->id) }}" method="POST" class="d-none">
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
            title: "Yakin ingin menghapus?",
            text: "Data guide ini akan dihapus secara permanen!",
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
