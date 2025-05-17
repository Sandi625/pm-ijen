@extends('layouts.base')

@section('title', 'Daftar Review')

@section('content')
<!-- review/index.blade.php -->
<div class="overflow-auto flex-grow-1">
    <!-- Create Button -->
    <div class="mb-3">
        <a href="{{ route('reviews.create') }}" class="btn btn-success">
            + Tambah Review
        </a>
    </div>

    <table class="table table-bordered w-100">
        <thead class="table-light">
            <tr>
                <th>NO</th>
                <th>Nama Guide</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Rating</th>
                <th>Isi Testimoni</th>
                <th>Foto</th>
                <th>Status</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $index => $review)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $review->nama_guide ?? 'Unknown Guide' }}</td> <!-- Tambah Nama Guide -->
                    <td>{{ $review->name }}</td>
                    <td>{{ $review->email }}</td>
                    <td>{{ $review->rating }} / 5</td>
                    <td>{{ Str::limit($review->isi_testimoni, 50) }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $review->photo) }}" alt="Foto" width="50">
                    </td>
                    <td>
                        @if ($review->status)
                            <span class="text-success">Aktif</span>
                        @else
                            <span class="text-danger">Tidak Aktif</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{ route('review.show', $review->id) }}" class="btn btn-info btn-sm">
                                <i class="fa-solid fa-eye"></i> Show
                            </a>
                            <a href="{{ route('review.edit', $review->id) }}" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <button onclick="confirmDelete({{ $review->id }})" class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </div>
                        <form id="delete-form-{{ $review->id }}" action="{{ route('review.destroy', $review->id) }}" method="POST" class="d-none">
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
            text: "Review ini akan dihapus secara permanen!",
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
