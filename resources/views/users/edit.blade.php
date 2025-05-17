@extends('layouts.base')

@section('title', 'Edit User')

@section('content')
    <div class="container-fluid min-vh-100 d-flex flex-column">
        <div class="bg-white shadow-md rounded-lg p-4 flex-grow-1 d-flex flex-column">
            <h1 class="text-3xl font-bold mb-4 text-gray-800">Edit User</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" id="name" name="name" class="form-control"
                        value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                        value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password <small>(kosongkan jika tidak ingin
                            mengubah)</small></label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>

                <!-- Menambahkan kolom level -->
                <div class="mb-3">
                    <label for="level" class="form-label">Level</label>
                    <select id="level" name="level" class="form-control" required>
                        @foreach ($levels as $level)
                            <option value="{{ $level }}"
                                {{ old('level', $user->level) == $level ? 'selected' : '' }}>
                                {{ ucfirst($level) }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="d-flex justify-content-between">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
