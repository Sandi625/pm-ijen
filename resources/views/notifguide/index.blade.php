@extends('layouts.base')

@section('title', 'Daftar Guide yang Digunakan dalam Pesanan')

@section('content')
    <div class="overflow-auto flex-grow-1">
        <h4 class="mb-4">Daftar Guide yang Digunakan dalam Pesanan</h4>

        <table class="table table-bordered w-100">
            <thead class="table-light">
                <tr>
                    <th>NO</th>
                    <th>Nama Guide</th>
                    <th>Email</th>
                    <th>Bahasa</th>
                    <th>Nomor HP</th>
                    <th>Jumlah Pesanan</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guides as $index => $guide)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $guide->nama_guide }}</td>
                        <td>{{ $guide->email }}</td>
                        <td>{{ $guide->bahasa }}</td>
                        <td>{{ $guide->nomer_hp }}</td>
                        <td>{{ $guide->pesanans->count() }} Pesanan</td>
                        <td>
                            @if ($guide->status === 'aktif')
                                <span class="text-success">Aktif</span>
                            @elseif ($guide->status === 'sedang_guiding')
                                <span class="text-warning">Sedang Guiding</span>
                            @else
                                <span class="text-danger">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('guide.show', $guide->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa-solid fa-eye"></i> Detail
                                </a>
                                <a href="{{ route('guide.edit', $guide->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <a href="{{ route('guide.sendNotif', $guide->id) }}" class="btn btn-success btn-sm">
                                    Kirim Notif
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Include SweetAlert2 script --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
            });
        </script>
    @endif
@endsection
