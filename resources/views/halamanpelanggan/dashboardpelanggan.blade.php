@extends('layouts.master')

@section('content')
    <style>
        /* Basic styling */
        .section-title {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: var(--primary-text-color);
        }

        /* Container flex dengan wrap */
        .bd-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.5rem;
            padding: 1rem;
        }

        /* Card styling */
        .testimonials__card {
            background-color: var(--card-bg-color);
            border-radius: 10px;
            box-shadow: 0 4px 8px var(--hover-effect-color);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            text-align: center;
            padding: 1rem;
            transition: transform 0.3s ease-in-out;

            /* Ukuran untuk 3 per baris */
            width: calc(33.33% - 1rem);
            /* 3 per baris */
            max-width: 300px;
        }

        .testimonials__card:hover {
            transform: translateY(-10px);
            background-color: var(--card-hover-bg-color);
        }

        .testimonials__image {
            margin-bottom: 1rem;
            height: 200px;
        }

        .testimonials__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .testimonials__info {
            padding: 0.5rem;
        }

        .testimonials__name {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: var(--primary-text-color);
        }

        .testimonials__description {
            font-size: 1rem;
            color: var(--secondary-text-color);
            margin-bottom: 0.5rem;
        }

        .testimonials__price,
        .testimonials__duration,
        .testimonials__destinasi,
        .testimonials__include,
        .testimonials__exclude {
            font-size: 0.9rem;
            margin: 0.2rem 0;
            color: var(--primary-text-color);
        }

        .testimonials__price {
            font-weight: bold;
        }

        .testimonials__include {
            color: var(--include-color);
            /* Warna hijau */
        }

        .testimonials__exclude {
            color: var(--exclude-color);
            /* Warna merah */
        }

        /* Responsive */
        @media screen and (max-width: 992px) {
            .testimonials__card {
                width: calc(33.33% - 1rem);
                /* 3 per baris (untuk ukuran layar PC) */
            }
        }

        @media screen and (max-width: 600px) {
            .testimonials__card {
                width: 100%;
                /* 1 per baris */
            }

            .testimonials__image {
                height: 180px;
            }
        }
    </style>
    <section id="tour-pakets">
        <h2 class="section-title">Tour Pakets</h2>
        <div class="bd-container testimonials__container">
            @foreach ($pakets as $paket)
                <div class="testimonials__card">
                    <div class="testimonials__image">
                        @if ($paket->foto)
                            <a href="{{ route('pesanan.create', ['id_paket' => $paket->id]) }}">
                                <img src="{{ asset('storage/' . $paket->foto) }}" alt="Foto Paket"
                                    class="w-full h-40 object-cover rounded-lg hover:opacity-90 transition-opacity duration-300">
                            </a>
                        @else
                            <p>Foto tidak tersedia</p>
                        @endif
                    </div>
                    <div class="testimonials__info">
                        <h3 class="testimonials__name">{{ $paket->nama_paket }}</h3>
                        <p class="testimonials__description">{{ Str::limit($paket->deskripsi_paket, 100) }}</p>
                        <p class="testimonials__duration">Durasi: {{ $paket->durasi }}</p>

                        <!-- Tombol Detail -->
                        <a href="{{ route('pesanan.create', ['id_paket' => $paket->id]) }}"
                            class="inline-block mt-4 px-6 py-2.5 bg-gradient-to-r from-green-500 to-green-700 text-blue-500 font-semibold text-sm rounded-full shadow-lg hover:from-green-600 hover:to-green-800 transition-all duration-300 ease-in-out">
                            💼 Klik For More
                        </a>


                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
