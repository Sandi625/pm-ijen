@extends('layouts.base')

@section('title', 'Daftar Guide')

@section('content')
<!-- guide/index.blade.php -->
<div class="overflow-auto flex-grow-1">
    <!-- Create Button -->
    <div class="mb-3">
        <a href="{{ route('guide.create') }}" class="btn btn-success">
            + Tambah Guide
        </a>
    </div>

    <table class="table table-bordered w-100">
        <thead class="table-light">
            <tr>
                <th>NO</th>
                <th>Nama Guide</th>
                <th>Salary</th>
                <th>Kriteria Unggulan</th>
                <th>Deskripsi</th>
                <th>Nomor HP</th>
                <th>Status</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Bahasa</th>
                <th>Foto</th>

                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($guides as $index => $guide)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $guide->nama_guide }}</td>
                    <td>Rp {{ number_format($guide->salary, 0, ',', '.') }}</td>
<td>{{ $guide->nama_guide }} - {{ $guide->kriteria_unggulan_nama ?? 'Tidak Diketahui' }}</td>
<td>{{ \Illuminate\Support\Str::limit($guide->deskripsi_guide, 100, '...') }}</td>
                    <td>{{ $guide->nomer_hp }}</td>
                    <td>
                        @switch($guide->status)
                            @case('aktif')
                                <span class="text-success">Aktif</span>
                                @break
                            @case('sedang_guiding')
                                <span class="text-warning">Sedang Guiding</span>
                                @break
                            @case('tidak_aktif')
                                <span class="text-danger">Tidak Aktif</span>
                                @break
                            @default
                                <span>-</span>
                        @endswitch
                    </td>
                    <td>{{ $guide->alamat ?? '-' }}</td>
                    <td>{{ $guide->email }}</td>
                    <td>{{ $guide->bahasa }}</td>
                    <td>
                        @if($guide->foto)
                            <img src="{{ asset('storage/' . $guide->foto) }}" alt="Foto {{ $guide->nama_guide }}" width="60" height="60" class="rounded">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{ route('guide.show', $guide->id) }}" class="btn btn-info btn-sm">
            <i class="fa-solid fa-eye"></i> Show
        </a>
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
