let slideIndex = 1;
showSlides(slideIndex);

// Slider navigation
function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  const slides = document.getElementsByClassName("slide");
  const dots = document.getElementsByClassName("dot");
  
  if (n > slides.length) slideIndex = 1;
  if (n < 1) slideIndex = slides.length;

  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }

  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
}

// Toggle between forms (Login/Signup)
function toggleForm(formId) {
  const forms = document.querySelectorAll(".auth-form");
  forms.forEach(form => {
    form.style.display = "none";
  });

  const selectedForm = document.getElementById(formId);
  if (selectedForm) {
    selectedForm.style.display = "block";
  }
}

setInterval(() => {
  plusSlides(1);
}, 5000); // change slide every 5 seconds
