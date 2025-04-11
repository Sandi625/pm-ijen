@extends('layouts.base')

@section('title', 'Daftar Kriteria')

@section('content')
<div class="container-fluid vh-100 d-flex flex-column">
    <div class="bg-white shadow-md rounded-lg p-4 flex-grow-1">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Daftar Kriteria</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('kriteria.create') }}" class="btn btn-success mb-4">
            <i class="fa-solid fa-plus"></i> Tambah Kriteria
        </a>

        <div class="overflow-auto">
            <table class="table table-bordered w-100">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($kriterias as $kriteria)
                        <tr>
                            <td>{{ $kriteria->kode }}</td>
                            <td>{{ $kriteria->nama }}</td>
                            <td>{{ $kriteria->deskripsi }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('kriteria.edit', $kriteria) }}" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <button onclick="confirmDelete({{ $kriteria->id }})" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </div>
                                <form id="delete-form-{{ $kriteria->id }}" action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST" class="d-none">
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
