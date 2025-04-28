@extends('layouts.base')

@section('title', 'Galeri')

@section('content')
    <!-- Container for Gallery -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Galeri</h2>

        <!-- Button Tambah Galeri -->
        <div class="text-center mb-4">
            <a href="{{ route('galeris.create') }}" class="btn btn-success">+ Tambah Galeri</a>
        </div>

        <!-- Gallery Grid -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($galeris as $galeri)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <!-- Media Section -->
                        @if ($galeri->foto && file_exists(public_path('storage/' . $galeri->foto)))
                            <img src="{{ asset('storage/' . $galeri->foto) }}" class="card-img-top img-fluid"
                                 style="height: 150px; object-fit: cover;" alt="{{ $galeri->judul }}">
                        @elseif ($galeri->videoyoutube)
                            @php
                                // Regular expression to extract the video ID from YouTube URL
                                $youtubeId = null;
                                if (
                                    preg_match(
                                        '/(?:https?:\/\/(?:www\.)?youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
                                        $galeri->videoyoutube,
                                        $matches
                                    )
                                ) {
                                    $youtubeId = $matches[1];
                                }
                            @endphp

                            @if ($youtubeId)
                                <!-- YouTube Video Thumbnail -->
                                <div class="ratio ratio-16x9 position-relative">
                                    <img src="https://img.youtube.com/vi/{{ $youtubeId }}/maxresdefault.jpg"
                                         alt="YouTube video thumbnail" class="img-fluid"
                                         style="height: 150px; object-fit: cover;">
                                    <!-- Embed YouTube Video with iframe -->
                                    <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                            title="YouTube video" frameborder="0" allowfullscreen
                                            class="position-absolute top-0 start-0 w-100 h-100"
                                            style="opacity: 0;">
                                    </iframe>
                                </div>
                            @else
                                <!-- If no valid YouTube ID is found -->
                                <div class="bg-secondary text-white text-center d-flex align-items-center justify-content-center"
                                     style="height: 150px;">
                                    Video YouTube Tidak Valid
                                </div>
                            @endif
                        @elseif ($galeri->videolokal && file_exists(public_path('storage/' . $galeri->videolokal)))
                            <!-- Local Video -->
                            <video class="card-img-top" style="height: 150px; object-fit: cover;" controls>
                                <source src="{{ asset('storage/' . $galeri->videolokal) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <!-- No Video or Image -->
                            <div class="bg-secondary text-white text-center d-flex align-items-center justify-content-center"
                                 style="height: 150px;">
                                No Media
                            </div>
                        @endif

                        <!-- Card Body -->
                        <div class="card-body">
                            <h5 class="card-title text-truncate">{{ $galeri->judul }}</h5>
                            <p class="card-text">{{ Str::limit($galeri->deskripsi, 80) }}</p>
                        </div>

                        <!-- Card Footer -->
                        <div class="card-footer d-flex justify-content-between">
                            {{-- <a href="{{ route('galeris.edit', $galeri->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                            <!-- Delete Form with confirmation -->
                            <form id="delete-form-{{ $galeri->id }}" action="{{ route('galeris.destroy', $galeri->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $galeri->id }})">Hapus</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $galeris->links() }}
        </div>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Yakin ingin menghapus?",
                text: "Data galeri ini akan dihapus secara permanen!",
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
