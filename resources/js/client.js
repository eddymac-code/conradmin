// import '../css/client.css';

// Get the homepage URL
var homepageURL = window.location.origin;
console.log(homepageURL);
console.log(window.location.href);

if (window.location.href === window.location.origin + '/') {
  const slides = document.querySelectorAll('.slider img');
  const prevBtn = document.querySelector('.prev');
  const nextBtn = document.querySelector('.next');

  let currentSlide = 0;

  // Show the first slide and hide the rest
  slides[currentSlide].classList.add('active');
  for (let i = 1; i < slides.length; i++) {
    slides[i].classList.remove('active');
  }

  // Go to the next slide
  function nextSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
  }

  // Go to the previous slide
  function prevSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    slides[currentSlide].classList.add('active');
  }

  // Change slide every 5 seconds
  setInterval(nextSlide, 5000);

  // Add event listeners to buttons
  // nextBtn.addEventListener('click', nextSlide);
  // prevBtn.addEventListener('click', prevSlide);

  // function openPageSection(pageName, elmnt, color) {
  //   // Hide all elements with class="tabcontent" by default */
  //   var i, tabcontent, tablinks;
  //   tabcontent = document.getElementsByClassName("tab-content");
  //   for (i = 0; i < tabcontent.length; i++) {
  //     tabcontent[i].style.display = "none";
  //   }

  //   // Remove the background color of all tablinks/buttons
  //   tablinks = document.getElementsByClassName("tablink");
  //   for (i = 0; i < tablinks.length; i++) {
  //     tablinks[i].style.backgroundColor = "";
  //   }

  //   // Show the specific tab content
  //   document.getElementById(pageName).style.display = "block";

  //   // Add the specific color to the button used to open the tab content
  //   elmnt.style.backgroundColor = color;
  //   elmnt.style.color = goldenrod;
  // }

  // Get the element with id="defaultOpen" and click on it
  // document.getElementById("defaultOpen").click();

  // Scroll to particular page section upon loading  
}

let date = new Date();
let year = date.getFullYear();
document.getElementById('year').innerHTML = year;


scrollToContent();
function scrollToContent() {
  window.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () {
      var section = document.getElementById('maincontent');
      section.scrollIntoView();
    }, 3000);
  });
}

assignActivestatus();

function assignActivestatus() {
  document.addEventListener("DOMContentLoaded", function () {
    var links = document.querySelectorAll(".nav-link");
    var currentUrl = window.location.href;

    for (var i = 0; i < links.length; i++) {
      var link = links[i];
      if (link.href === currentUrl) {
        link.classList.add("active");
        break;
      }
    }
  });
}

