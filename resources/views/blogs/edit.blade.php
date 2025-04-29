@extends('layouts.app')

@section('title', 'Edit Blog')

@section('content')
<div class="container-fluid min-vh-100 d-flex flex-column">
    <div class="bg-white shadow-md rounded-lg p-6 flex-grow-1 d-flex flex-column ml-6">
        <h1 class="text-4xl font-bold mb-6 text-gray-800">Edit Blog</h1>

        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Judul Input -->
            <div class="mb-4">
                <label for="title" class="block text-lg font-medium text-gray-700">Judul</label>
                <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukkan judul blog" required>
                @error('title')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Slug Input (Auto-generated) -->
            <div class="mb-4">
                <label for="slug" class="block text-lg font-medium text-gray-700">Slug</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $blog->slug) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Slug otomatis" readonly required>
                @error('slug')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Isi Konten Input -->
            <div class="mb-4">
                <label for="body" class="block text-lg font-medium text-gray-700">Isi</label>
                <textarea id="body" name="body" rows="4" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukkan isi blog">{{ old('body', $blog->body) }}</textarea>
                @error('body')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Gambar Blog (Opsional) -->
            <div class="mb-4">
                <label for="image" class="block text-lg font-medium text-gray-700">
                    Gambar
                    <span class="text-red-500">(Maksimal 2MB)</span>
                </label>
                <input type="file" id="image" name="image" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('image')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
                <!-- Menampilkan gambar lama jika ada -->
                @if ($blog->image)
                    <div class="mt-4">
                        <img src="{{ asset('storage/blogs/' . $blog->image) }}" alt="{{ $blog->title }}" width="80">
                    </div>
                @endif
            </div>


            <!-- Status (Checkbox) -->
            <div class="mb-4">
                <label for="status" class="block text-lg font-medium text-gray-700">Aktifkan Blog</label>
                <input type="checkbox" id="status" name="status" value="1" class="mt-1" {{ old('status', $blog->status) ? 'checked' : '' }}>
                @error('status')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-success mt-8 px-8 py-3 rounded-md bg-green-500 text-white hover:bg-green-600 text-xl">Update Blog</button>
            </div>
        </form>
    </div>
</div>

{{-- Script untuk otomatis mengisi slug berdasarkan judul --}}
<script>
    document.getElementById('title').addEventListener('input', function() {
        let title = this.value;
        let slug = title.toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '') // Hapus karakter non-alfabet dan angka
                        .trim()
                        .replace(/\s+/g, '-')         // Ganti spasi menjadi strip
                        .replace(/-+/g, '-');         // Hapus strip ganda
        document.getElementById('slug').value = slug;
    });
</script>
@endsection
