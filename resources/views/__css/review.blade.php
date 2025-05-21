<style>
    /*========== TESTIMONIALS ==========*/
    .testimonials {
        padding: 3rem 0;
        /* Konsistensi jarak */
        background-color: #f4f4f4;
        /* Warna latar belakang utama */
    }

    .section-title {
        text-align: center;
        font-size: 2.5rem;
        /* Ukuran font */
        color: #07412a;
        /* Warna judul */
        margin-bottom: 2rem;
    }

    .testimonials__container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .testimonials__card {
        background: #07412a;
        border-radius: 0.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        /* Efek bayangan lembut */
        padding: 1rem;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        /* Efek transisi */
    }

    /* Animasi hover untuk kartu testimonial */
    .testimonials__card:hover {
        transform: translateY(-10px);
        /* Mengangkat kartu saat hover */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        /* Bayangan lebih besar */
    }

    .testimonials__header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .testimonials__image {
        margin-right: 1rem;
    }

    .testimonials__image img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .testimonials__name {
        font-weight: 600;
        /* Font semi-bold */
        font-size: 1.2rem;
        /* Ukuran font */
        margin-bottom: 0.5rem;
        color: #ffffff;
    }

    .testimonials__rating {
        color: #f39c12;
        /* Warna bintang */
    }

    .star {
        font-size: 1.2rem;
        margin-right: 0.2rem;
    }

    .testimonials__description {
        font-size: 1rem;
        /* Ukuran font */
        color: #ffffff;
        /* Warna teks */
        text-align: center;
        /* Memusatkan teks secara horizontal */
        display: flex;
        align-items: center;
        /* Memusatkan secara vertikal */
        justify-content: center;
        /* Memusatkan secara horizontal */
        height: 100%;
        /* Menjamin deskripsi mengisi ruang yang ada */
    }

    @media (max-width: 768px) {
        .testimonials__card {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .section-title {
            font-size: 2rem;
            /* Ukuran font untuk tampilan lebih kecil */
        }

        .testimonials__card {
            width: 100%;
        }
    }
</style>
