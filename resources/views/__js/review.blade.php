
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Add Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
const swiper = new Swiper('.swiper-container', {
    slidesPerView: 2, // Tampilkan dua slide per baris
    spaceBetween: 20, // Jarak antar slide
    grid: {
        rows: 1, // Hanya satu baris per tampilan
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    breakpoints: {
        // Responsif untuk tampilan lebih kecil
        768: {
            slidesPerView: 1, // Satu slide per tampilan di layar kecil
        },
    },
});




    // <!-- Initialize Swiper -->

        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 50,
                },
            }
        });

        var swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 10,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 40,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 50,
        },
    }
});










    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');
    const navClose = document.getElementById('nav-close');

    // Menampilkan menu saat tombol toggle diklik
    if (navToggle) {
        navToggle.addEventListener('click', () => {
            navMenu.classList.add('show-menu');
        });
    }

    // Menyembunyikan menu saat tombol close diklik
    if (navClose) {
        navClose.addEventListener('click', () => {
            navMenu.classList.remove('show-menu');
        });
    }

    // Menyembunyikan menu saat link di-klik (opsional)
    const navLink = document.querySelectorAll('.nav__link');
    navLink.forEach(link => {
        link.addEventListener('click', () => {
            navMenu.classList.remove('show-menu');
        });
    });



    document.getElementById('review-form').addEventListener('submit', function(event) {
let name = document.getElementById('name').value;
let email = document.getElementById('email').value;
let rating = document.getElementById('rating').value;
let review = document.getElementById('review').value;

if (!name || !email || !rating || !review) {
    event.preventDefault();
    alert('Please fill in all the fields.');
}
});


document.addEventListener('DOMContentLoaded', function () {
var swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 10,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
});
});















// <!-- Initialize Swiper -->

    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 50,
            },
        }
    });

    var swiper = new Swiper('.swiper-container', {
slidesPerView: 1,
spaceBetween: 10,
pagination: {
    el: '.swiper-pagination',
    clickable: true,
},
breakpoints: {
    640: {
        slidesPerView: 1,
        spaceBetween: 20,
    },
    768: {
        slidesPerView: 2,
        spaceBetween: 40,
    },
    1024: {
        slidesPerView: 3,
        spaceBetween: 50,
    },
}
});

</script>
