<script>
   // Menu toggle functionality
const navToggle = document.getElementById('nav-toggle');
const navMenu = document.getElementById('nav-menu');
const navClose = document.getElementById('nav-close');

if (navToggle) {
    navToggle.addEventListener('click', () => {
        navMenu.classList.add('show-menu');
    });
}

if (navClose) {
    navClose.addEventListener('click', () => {
        navMenu.classList.remove('show-menu');
    });
}

// Hide menu on link click (optional)
const navLink = document.querySelectorAll('.nav__link');
navLink.forEach(link => {
    link.addEventListener('click', () => {
        navMenu.classList.remove('show-menu');
    });
});

// Toggle between images and videos
function showImages() {
    const imageItems = document.querySelectorAll('.image-item');
    const videoItems = document.querySelectorAll('.video-item');

    imageItems.forEach(item => item.style.display = 'block');
    videoItems.forEach(item => item.style.display = 'none');
}

function showVideos() {
    const imageItems = document.querySelectorAll('.image-item');
    const videoItems = document.querySelectorAll('.video-item');

    imageItems.forEach(item => item.style.display = 'none');
    videoItems.forEach(item => item.style.display = 'block');
}

// Default to showing images on page load
showImages();

// Modal Image View
var modal = document.getElementById("myModal");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");

var images = document.querySelectorAll('.myImg');
images.forEach(function(img) {
    img.onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }
});

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


</script>
