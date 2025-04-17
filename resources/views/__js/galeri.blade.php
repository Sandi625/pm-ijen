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
        document.querySelector('.gallery-container').style.display = 'grid';
        document.querySelector('.video-section').style.display = 'none';
    }

    function showVideos() {
        document.querySelector('.gallery-container').style.display = 'none';
        document.querySelector('.video-section').style.display = 'block';
    }

    // Default to showing images on page load
    showImages();



const videoFile = document.getElementById('video-file'),
  videoButton = document.getElementById('video-button'),
  videoIcon = document.getElementById('video-icon')

function playPause(){
if (videoFile.paused){
    // Play video
    videoFile.play()
    // We change the icon
    videoIcon.classList.add('ri-pause-line')
    videoIcon.classList.remove('ri-play-line')
}
else {
    // Pause video
    videoFile.pause();
    // We change the icon
    videoIcon.classList.remove('ri-pause-line')
    videoIcon.classList.add('ri-play-line')

}
}



var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function() {
modal.style.display = "block";
modalImg.src = this.src;
captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
modal.style.display = "none";
}


// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var images = document.querySelectorAll('.myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");

images.forEach(function(img) {
img.onclick = function(){
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
