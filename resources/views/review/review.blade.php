<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private Ijen Crater - Blue Fire Tour from Bali</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/2.5.0/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="review.css">


    @include('__js.review')


</head>

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

<body>
    <header>
        <h1>Review From Clients</h1>
        <h2></h2>
    </header>

    <nav class="nav">
        <div class="nav__logo">
            <img src="{{ asset('assets/img/logo.jpg') }}" alt="Brand Logo" style="height: 40px;">
        </div>
        <div class="nav__toggle" id="nav-toggle">&#9776;</div>
        <ul class="nav__menu" id="nav-menu">
            <li class="nav__item">
                <a href="{{ route('home') }}" class="nav__link active-link">Home</a>
            </li>
            <li class="nav__item">
                <a href="{{ route('home') }}#about" class="nav__link">About</a>
            </li>
            <li class="nav__item">
                <a href="{{ route('home') }}#discover" class="nav__link">Destination</a>
            </li>
            <li class="nav__item">
                <a href="{{ route('home') }}#place" class="nav__link">Tours</a>
            </li>
            <li class="nav__item">
                <a href="{{ route('galeri') }}" class="nav__link">Gallery</a>
            </li>
            <li class="nav__item">
                <a href="{{ route('review.review') }}" class="nav__link">Review</a>
            </li>
            <div class="nav__close" id="nav-close">&times;</div>
        </ul>
    </nav>


    <section id="add-review" class="review-section">
        <div class="container">
            <h2>Add Your Review</h2>
            <form id="review-form" action="{{ route('review.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="guide_id">Select Guide</label>
                    <select id="guide_id" name="guide_id" required>
                        <option value="" disabled selected>Select a Guide</option>
                        @foreach ($guides as $guide)
                            <option value="{{ $guide->id }}">{{ $guide->nama_guide }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <select id="rating" name="rating" required>
                        <option value="" disabled selected>Select your rating</option>
                        <option value="5">5 - Excellent</option>
                        <option value="4">4 - Very Good</option>
                        <option value="3">3 - Good</option>
                        <option value="2">2 - Fair</option>
                        <option value="1">1 - Poor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="isi_testimoni">Your Review</label>
                    <textarea id="isi_testimoni" name="isi_testimoni" rows="4" placeholder="Share your experience" required></textarea>
                </div>
                <div class="form-group">
                    <label for="photo">Upload a Photo (optional)</label>
                    <input type="file" id="photo" name="photo" accept="image/*">
                </div>
                <button type="submit" class="btn-submit">Submit Review</button>
            </form>
        </div>
    </section>



    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Succeed!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if ($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ $errors->first() }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        </script>
    @endif









    <section class="testimonials section">
        <h2 class="section-title">Testimoni</h2>
        <div class="bd-container testimonials__container">
            @if (isset($reviews) && $reviews->count())
                @foreach ($reviews as $review)
                    <div class="testimonials__card">
                        <div class="testimonials__header">
                            <div class="testimonials__image">
                                <img src="{{ $review->photo && $review->photo !== 'images/default-avatar.jpg' ? asset('storage/' . $review->photo) : asset('images/default-avatar.jpg') }}"
                                    alt="{{ $review->name }}">
                            </div>
                            <div>
                                <div class="testimonials__name">{{ $review->name }}</div>
                                <div class="testimonials__rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="star">{{ $i <= $review->rating ? '★' : '☆' }}</span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="testimonials__description">
                            "{{ $review->isi_testimoni }}"
                        </p>
                    </div>
                @endforeach
            @else
                <p class="text-center">Belum ada testimoni tersedia.</p>
            @endif
        </div>
    </section>



















    <!-- Add Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">



    <!-- Add Swiper JS -->


    <!-- Add Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <!-- Add Custom Styles -->




    <!--==================== FOOTER ====================-->
    <footer class="footer section">
        <div class="footer__container container grid">
            <div class="footer__content grid">
                <div class="footer__data">
                    <h3 class="footer__title">Travel</h3>
                    <p class="footer__description">Travel you choose the <br> destination,
                        we offer you the <br> experience.
                    </p>
                    <div>
                        <a href="https://www.facebook.com/profile.php?id=100090053510077" target="_blank"
                            class="footer__social">
                            <i class="ri-facebook-box-fill"></i>
                        </a>
                        <!-- <a href="https://twitter.com/" target="_blank" class="footer__social">
                                <i class="ri-twitter-fill"></i>
                            </a> -->
                        <a href="https://www.instagram.com/ijencratertour.indonesia/" target="_blank"
                            class="footer__social">
                            <i class="ri-instagram-fill"></i>
                        </a>
                        <a href="https://www.youtube.com/@E__AHMADDHANIIRJA" target="_blank" class="footer__social">
                            <i class="ri-youtube-fill"></i>
                        </a>
                    </div>
                </div>

                <div class="footer__data">
                    <h3 class="footer__subtitle">About</h3>
                    <ul>
                        <li class="footer__item">
                            <a href="" class="footer__link">About Us</a>
                        </li>
                        <li class="footer__item">
                            <a href="" class="footer__link">Features</a>
                        </li>
                        <li class="footer__item">
                            <a href="" class="footer__link">New & Blog</a>
                        </li>
                    </ul>
                </div>

                <div class="footer__data">
                    <h3 class="footer__subtitle">Company</h3>
                    <ul>
                        <li class="footer__item">
                            <a href="https://wa.me/+6282331489128?text=Hello!%20I%20would%20like%20to%20get%20in%20touch."
                                target="_blank">
                                <i class="fab fa-whatsapp"></i> +6282331489128
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="https://wa.me/+6282132662815?text=Hello!%20I%20would%20like%20to%20get%20in%20touch."
                                target="_blank">
                                <i class="fab fa-whatsapp"></i> +6282132662815
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="https://wa.me/+6281381117555?text=Hello!%20I%20would%20like%20to%20get%20in%20touch."
                                target="_blank">
                                <i class="fab fa-whatsapp"></i> +6281381117555
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#"><i class="fas fa-envelope"></i>Ijencratertour.indonesia@gmail.com</a>
                        </li>
                        <li class="footer__item">
                            <a href="#"><i class="fas fa-map"></i> Licin, Banyuwangi - 68464</a>
                        </li>
                        <!-- <li class="footer__item">
                            <a href="#" class="footer__link">Team</a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">Plan & Pricing</a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">Become a member</a>
                        </li> -->
                    </ul>
                </div>

                <div class="footer__data">
                    <h3 class="footer__subtitle">Support</h3>
                    <ul>
                        <li class="footer__item">
                            <a href="" class="footer__link">FAQs</a>
                        </li>
                        <li class="footer__item">
                            <a href="" class="footer__link">Support Center</a>
                        </li>
                        <li class="footer__item">
                            <a href="" class="footer__link">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer__rights">
                <p class="footer__copy">&#169; Ijen Creater Indonesia. All rigths reserved.</p>
                <div class="footer__terms">
                    <a href="#" class="footer__terms-link">Terms & Agreements</a>
                    <a href="#" class="footer__terms-link">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="bali.js"></script>



</body>

</html>
