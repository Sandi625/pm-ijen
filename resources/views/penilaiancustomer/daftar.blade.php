@extends('layouts.base')

@section('content')
<div class="container-fluid px-4 mt-4">
    <h1 class="h3 mb-4 text-gray-800">Daftar Guide</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($guides->isEmpty())
        <div class="alert alert-info">Belum ada data guide tersedia.</div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Guide</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama Guide</th>
                                <th style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guides as $guide)
                                <tr>
                                    <td>{{ $guide->nama_guide }}</td>
                                    <td>
                                        <a href="{{ route('penilaian.customerShow', $guide->id) }}" class="btn btn-primary btn-sm">
                                            Lihat Penilaian Customer
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
