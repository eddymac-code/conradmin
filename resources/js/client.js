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

// assignActiveMStatus();

// function assignActiveMStatus() {
//   document.addEventListener("DOMContentLoaded", function () {
//     var links = document.querySelectorAll(".mobi-link");
//     var currentUrl = window.location.href;

//     for (var i = 0; i < links.length; i++) {
//       var link = links[i];
//       if (link.href === currentUrl) {
//         link.classList.add("active-mlink");
//         document.getElementById('activeMobileLinkSpace').innerHTML = link;
//         break;
//       }
//     }
//   });
// }

function toggleContent() {
  var content = document.getElementById("content-box");
  var toggleButton = document.getElementById("toggleButton");

  content.classList.toggle("expanded");
  toggleButton.classList.toggle("collapsed");
}

// for showing popover on guests occupancy input
var adultsCount = 1;
    var childrenCount = 0;
    var guestsInput = document.getElementById('guestsInput');
    var adultsCountElement = document.getElementById('adultsCount');
    var childrenCountElement = document.getElementById('childrenCount');
    var popover = document.querySelector('.p-over');
    var popoverContent = document.querySelector('.p-over-content');

    function updateGuestsInput() {
      var adultsText = adultsCount === 1 ? 'adult' : 'adults';
      var childrenText = childrenCount === 1 ? 'child' : 'children';
      guestsInput.value = adultsCount + ' ' + adultsText + ' ' + childrenCount + ' ' + childrenText;
    }

    function updateCounts() {
      adultsCountElement.textContent = adultsCount;
      childrenCountElement.textContent = childrenCount;
      updateGuestsInput();
    }

    function decrementCount(type) {
      if (type === 'adults') {
        if (adultsCount > 1) {
          adultsCount--;
        }
      } else if (type === 'children') {
        if (childrenCount > 0) {
          childrenCount--;
        }
      }
      updateCounts();
    }

    function incrementCount(type) {
      if (type === 'adults') {
        adultsCount++;
      } else if (type === 'children') {
        childrenCount++;
      }
      updateCounts();
    }

    function handleClickOutside(event) {
      if (!popover.contains(event.target)) {
        popover.classList.remove('active');
      }
    }

    document.getElementById('adultsDecrement').addEventListener('click', function (event) {
      event.preventDefault();
      decrementCount('adults');
    });

    document.getElementById('adultsIncrement').addEventListener('click', function (event) {
      event.preventDefault();
      incrementCount('adults');
    });

    document.getElementById('childrenDecrement').addEventListener('click', function (event) {
      event.preventDefault();
      decrementCount('children');
    });

    document.getElementById('childrenIncrement').addEventListener('click', function (event) {
      event.preventDefault();
      incrementCount('children');
    });

    guestsInput.addEventListener('click', function (event) {
      event.preventDefault();
      popover.classList.toggle('active');
    });

    document.addEventListener('click', handleClickOutside);

    updateGuestsInput();

