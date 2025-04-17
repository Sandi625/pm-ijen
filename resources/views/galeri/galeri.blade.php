<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="galeri.css">
    <link rel="stylesheet" href="https://unpkg.com/remixicon/fonts/remixicon.css">

    @include('__js.galeri')

    <!-- <link rel="stylesheet" href="bali.css"> -->
</head>
<body>
    <!-- Header -->
    <header>
        <h1>Welcome to the Gallery</h1>
        <!-- <h2>2 Day 1 Night</h2> -->
    </header>

    <!-- Navigation -->
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
                {{-- <a href="{{ route('page.review') }}" class="nav__link">Review</a> --}}
            </li>
            <div class="nav__close" id="nav-close">&times;</div>
        </ul>
    </nav>



    <!-- Main Section -->
    <main class="main">
        <!-- Gallery Options -->
        <section class="section">
            <h2 class="section__title">Gallery</h2>
            <div class="gallery-options">
                <button onclick="showImages()">Images</button>
                <button onclick="showVideos()">Videos</button>
            </div>
        </section>

        <!-- Gallery Images -->
        <section class="gallery-container">
            <div class="discover__card">
                <img id="myImg" src="../assets/img/10.jpg" alt="Snow" style="width:100%;max-width:300px">
                <!-- <div class="discover__data"> -->
                    <!-- <h3 class="discover__title">Blue Fire</h3> -->
                    <!-- <span class="discover__description">A beautiful Blue fire.</span> -->
                </div>
            </div>
            <div class="discover__card">
                <img id="myImg" src="../assets/img/1qq.jpg" alt="Snow" style="width:100%;max-width:300px">
                <!-- <div class="discover__data"> -->
                    <!-- <h3 class="discover__title">Blue Fire</h3> -->
                    <!-- <span class="discover__description">A beautiful Blue fire.</span> -->
                </div>
            </div>
            <div class="discover__card">
                <img id="myImg" src="../assets/img/9.png" alt="Snow" style="width:100%;max-width:300px">
                <!-- <div class="discover__data"> -->
                    <!-- <h3 class="discover__title">Blue Fire</h3> -->
                    <!-- <span class="discover__description">A beautiful Blue fire.</span> -->
                </div>
            </div>
            <div class="discover__card">
                <img id="myImg" src="../assets/img/12.jpg" alt="Snow" style="width:100%;max-width:300px">
                <!-- <div class="discover__data"> -->
                    <!-- <h3 class="discover__title">Blue Fire</h3> -->
                    <!-- <span class="discover__description">A beautiful Blue fire.</span> -->
                </div>
            </div>
            <div class="discover__card">
                <img id="myImg" src="../assets/img/13qq.jpg" alt="Snow" style="width:100%;max-width:300px">
                <!-- <div class="discover__data"> -->
                    <!-- <h3 class="discover__title">Blue Fire</h3> -->
                    <!-- <span class="discover__description">A beautiful Blue fire.</span> -->
                </div>
            </div>
            <div class="discover__card">
                <img id="myImg" src="../assets/img/47.jpg" alt="Snow" style="width:100%;max-width:300px">
                <!-- <div class="discover__data"> -->
                    <!-- <h3 class="discover__title">Blue Fire</h3> -->
                    <!-- <span class="discover__description">A beautiful Blue fire.</span> -->
                </div>
            </div>
            <div class="discover__card">
                <img id="myImg" src="../assets/img/45.jpg" alt="Snow" style="width:100%;max-width:300px">
                <!-- <div class="discover__data"> -->
                    <!-- <h3 class="discover__title">Blue Fire</h3> -->
                    <!-- <span class="discover__description">A beautiful Blue fire.</span> -->
                </div>
            </div>
            <div class="discover__card">
                <img id="myImg" src="../assets/img/bule1.jpg" alt="Snow" style="width:100%;max-width:300px">
                <!-- <div class="discover__data"> -->
                    <!-- <h3 class="discover__title">Blue Fire</h3> -->
                    <!-- <span class="discover__description">A beautiful Blue fire.</span> -->
                </div>
            </div>
            <div class="discover__card">
                <img id="myImg" src="../assets/img/bule2.jpg" alt="Snow" style="width:100%;max-width:300px">
                <!-- <div class="discover__data"> -->
                    <!-- <h3 class="discover__title">Blue Fire</h3> -->
                    <!-- <span class="discover__description">A beautiful Blue fire.</span> -->
                </div>
            </div>
            <div class="discover__card">
                <img id="myImg" src="../assets/img/bule3.jpg" alt="Snow" style="width:100%;max-width:300px">
                <!-- <div class="discover__data"> -->
                    <!-- <h3 class="discover__title">Blue Fire</h3> -->
                    <!-- <span class="discover__description">A beautiful Blue fire.</span> -->
                </div>
            </div>
            <div class="discover__card">
                <img id="myImg" src="../assets/img/bule4.jpg" alt="Snow" style="width:100%;max-width:300px">
                <!-- <div class="discover__data"> -->
                    <!-- <h3 class="discover__title">Blue Fire</h3> -->
                    <!-- <span class="discover__description">A beautiful Blue fire.</span> -->
                </div>
            </div>
            <div class="discover__card">
                <img id="myImg" src="../assets/img/bule5.jpg" alt="Snow" style="width:100%;max-width:300px">
                <!-- <div class="discover__data"> -->
                    <!-- <h3 class="discover__title">Blue Fire</h3> -->
                    <!-- <span class="discover__description">A beautiful Blue fire.</span> -->
                </div>
            </div>
            <div class="discover__card">
                <img id="myImg" src="../assets/img/bule6.jpg" alt="Snow" style="width:100%;max-width:300px">
                <!-- <div class="discover__data"> -->
                    <!-- <h3 class="discover__title">Blue Fire</h3> -->
                    <!-- <span class="discover__description">A beautiful Blue fire.</span> -->
                </div>
            </div>

        </section>

        <div id="myModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
          </div>
        <!-- Video Section -->
       <!-- Video Section -->
<section class="video-section">
    <h2 class="section__title">Featured Videos</h2>
    <div class="container video-container">
        <!-- Video YouTube -->
        <div class="video-wrapper">
            <iframe src="https://www.youtube.com/embed/E0WT1HtB-Sc" title="YouTube video 1" allowfullscreen></iframe>
        </div>
        <div class="video-wrapper">
            <iframe src="https://www.youtube.com/embed/65yoSXHo0KU" title="YouTube video 2" allowfullscreen></iframe>
        </div>


        <!-- Video Lokal -->
        <div class="video__container container">
            <p class="video__description">Find out more with our video of the most beautiful and pleasant places for you and your family.</p>
            <div class="video-grid">
                <video width="400" controls>
                    <source src="../assets/video/0.mp4" type="video/mp4">
                    <source src="../assets/video/0.ogg" type="video/ogg">
                    Your browser does not support HTML video.
                </video>
                <video width="400" controls>
                    <source src="../assets/video/1.mp4" type="video/mp4">
                    <source src="../assets/video/1.ogg" type="video/ogg">
                    Your browser does not support HTML video.
                </video>
                <video width="400" controls>
                    <source src="../assets/video/2.mp4" type="video/mp4">
                    <source src="../assets/video/2.ogg" type="video/ogg">
                    Your browser does not support HTML video.
                </video>
                <video width="400" controls>
                    <source src="../assets/video/3.mp4" type="video/mp4">
                    <source src="../assets/video/3.ogg" type="video/ogg">
                    Your browser does not support HTML video.
                </video>
                <video width="400" controls>
                    <source src="../assets/video/4.mp4" type="video/mp4">
                    <source src="../assets/video/4.ogg" type="video/ogg">
                    Your browser does not support HTML video.
                </video>
                <video width="400" controls>
                    <source src="../assets/video/5.mp4" type="video/mp4">
                    <source src="../assets/video/5.ogg" type="video/ogg">
                    Your browser does not support HTML video.
                </video>
                <video width="400" controls>
                    <source src="../assets/video/6.mp4" type="video/mp4">
                    <source src="../assets/video/6.ogg" type="video/ogg">
                    Your browser does not support HTML video.
                </video>
                <video width="400" controls>
                    <source src="../assets/video/7.mp4" type="video/mp4">
                    <source src="../assets/video/7.ogg" type="video/ogg">
                    Your browser does not support HTML video.
                </video>
                <video width="400" controls>
                    <source src="../assets/video/8.mp4" type="video/mp4">
                    <source src="../assets/video/8.ogg" type="video/ogg">
                    Your browser does not support HTML video.
                </video>
                <video width="400" controls>
                    <source src="../assets/video/9.mp4" type="video/mp4">
                    <source src="../assets/video/9.ogg" type="video/ogg">
                    Your browser does not support HTML video.
                </video>

            </div>
        </div>
    </div>
</section>




    </main>

    <!-- Footer -->
    <footer class="footer section">
        <div class="footer__container container grid">
            <div class="footer__content grid">
                <div class="footer__data">
                    <h3 class="footer__title">Travel</h3>
                    <p class="footer__description">Travel you choose the <br> destination, we offer you the <br> experience.</p>
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
                        <li class="footer__item"><a href="" class="footer__link">About Us</a></li>
                        <li class="footer__item"><a href="" class="footer__link">Features</a></li>
                        <li class="footer__item"><a href="" class="footer__link">New & Blog</a></li>
                    </ul>
                </div>

                <div class="footer__data">
                    <h3 class="footer__subtitle">Company</h3>
                    <ul>
                        <li class="footer__item">
                            <a href="https://wa.me/+6282331489128?text=Hello!%20I%20would%20like%20to%20get%20in%20touch." target="_blank">
                                <i class="fab fa-whatsapp"></i> +6282331489128
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="https://wa.me/+6282132662815?text=Hello!%20I%20would%20like%20to%20get%20in%20touch." target="_blank">
                                <i class="fab fa-whatsapp"></i> +6282132662815
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="https://wa.me/+6281381117555?text=Hello!%20I%20would%20like%20to%20get%20in%20touch." target="_blank">
                                <i class="fab fa-whatsapp"></i> +6281381117555
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#"><i class="fas fa-envelope"></i>Ijencratertour.indonesia@gmail.com</a>
                        </li>
                        <li class="footer__item">
                            <a href="#"><i class="fas fa-map"></i> Licin, Banyuwangi - 68464</a>
                        </li>
                    </ul>
                </div>

                <div class="footer__data">
                    <h3 class="footer__subtitle">Support</h3>
                    <ul>
                        <li class="footer__item"><a href="" class="footer__link">FAQs</a></li>
                        <li class="footer__item"><a href="" class="footer__link">Support Center</a></li>
                        <li class="footer__item"><a href="" class="footer__link">Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer__rights">
                <p class="footer__copy">&#169; Ijen Creater Indonesia. All rights reserved.</p>
                <div class="footer__terms">
                    <a href="#" class="footer__terms-link">Terms & Agreements</a>
                    <a href="#" class="footer__terms-link">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="bali.js"></script>

</body>
</html>
