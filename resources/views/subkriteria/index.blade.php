@extends('layouts.base')

@section('title', 'Daftar Subkriteria')

@section('content')
<div class="container-fluid min-vh-100 d-flex flex-column">
    <div class="bg-white shadow-md rounded-lg p-4 flex-grow-1 d-flex flex-column">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Daftar Subkriteria</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="text-start mb-4">
            <a href="{{ route('subkriteria.create') }}" class="btn btn-success">
                <i class="fa-solid fa-plus"></i> Tambah Subkriteria
            </a>
        </div>




        <div class="overflow-auto flex-grow-1">
            <table class="table table-bordered w-100">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Kriteria</th>
                        <th>Core Factor</th>
                        <th>Profil Standar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subkriterias as $subkriteria)
                        <tr>
                            <td>{{ $subkriteria->nama }}</td>
                            <td>{{ $subkriteria->kriteria->nama }}</td>
                            <td>{{ $subkriteria->is_core_factor ? 'Ya' : 'Tidak' }}</td>
                            <td>{{ $subkriteria->profil_standar }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('subkriteria.edit', $subkriteria->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <button onclick="confirmDelete({{ $subkriteria->id }})" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </div>
                                <form id="delete-form-{{ $subkriteria->id }}" action="{{ route('subkriteria.destroy', $subkriteria->id) }}" method="POST" class="d-none">
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
