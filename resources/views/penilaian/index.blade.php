@extends('layouts.base')

@section('title', 'Daftar Penilaian')

@section('content')
<div class="container-fluid min-vh-100 d-flex flex-column">
    <div class="bg-white shadow-md rounded-lg p-4 flex-grow-1 d-flex flex-column">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Daftar Penilaian</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="text-start mb-4">
            <a href="{{ route('penilaian.create') }}" class="btn btn-success">
                <i class="fa-solid fa-plus"></i> Tambah Penilaian
            </a>
            <a href="{{ route('penilaian.all') }}" class="btn btn-primary">
                <i class="fa-solid fa-list"></i> Lihat Keseluruhan Penilaian
            </a>
            <a href="{{ route('candidates.report') }}" class="btn btn-info">
                <i class="fa-solid fa-print"></i> Cetak penialai
            </a>
        </div>

        <div class="overflow-auto flex-grow-1">
            <table class="table table-bordered w-100">
                <thead class="table-light">
                    <tr>
                        <th>Nama Guide</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penilaians as $penilaian)
                        <tr>
                            <td>{{ optional($penilaian->guide)->nama_guide ?? 'Tidak Diketahui' }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('penilaian.show', $penilaian->id) }}" class="btn btn-success btn-sm">
                                        <i class="fa-solid fa-eye"></i> Lihat
                                    </a>
                                    <a href="{{ route('penilaian.edit', $penilaian->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <button onclick="confirmDelete({{ $penilaian->id }})" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </div>
                                <form id="delete-form-{{ $penilaian->id }}" action="{{ route('penilaian.destroy', $penilaian->id) }}" method="POST" class="d-none">
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
