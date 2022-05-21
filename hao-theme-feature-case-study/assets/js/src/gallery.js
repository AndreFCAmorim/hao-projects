var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("gallery__slides");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  slides[slideIndex-1].style.display = "block";
}


// Get the modal
var modal = document.getElementById("gallery__modal");

// Get the button that opens the modal
var btn = document.getElementsByClassName("gallery__see-more");

if (btn.length > 0) {
  // When the user clicks the button, open the modal
  btn[0].onclick = function() {
    modal.style.display = "block";
  }
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("gallery__modal-close");

if (span.length > 0) {
  // When the user clicks on <span> (x), close the modal
  span[0].onclick = function() {
    modal.style.display = "none";
  }
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}