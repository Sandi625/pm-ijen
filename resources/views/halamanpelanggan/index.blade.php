@extends('layouts.base')

@section('title', 'Daftar Paket')

@section('content')
<div class="container-fluid min-vh-100 d-flex flex-column">
    <div class="bg-white shadow-md rounded-lg p-4 flex-grow-1 d-flex flex-column">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Daftar User</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="text-start mb-4">
            <a href="{{ route('users.create') }}" class="btn btn-success">
                <i class="fa-solid fa-plus"></i> Tambah User
            </a>
        </div>

        <div class="overflow-auto flex-grow-1">
            <table class="table table-bordered w-100">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Level</th> <!-- Menambahkan kolom untuk Level -->
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->level }}</td> <!-- Menampilkan level user -->
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <button onclick="confirmDelete({{ $user->id }})" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </div>
                                <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-none">
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
            text: "Data user ini akan dihapus secara permanen!",
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

