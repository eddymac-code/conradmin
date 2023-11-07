import './bootstrap';

import jQuery from 'jquery';
window.$ = jQuery;

$(function () {
    if ($('#type').val() == 0) {
        $('#parent').hide();
    } else {
        $('#parent').show();
    }
    $('#type').on('change', function () {
        if ($('#type').val() == 0) {
            $('#parent').hide();
        } else {
            $('#parent').show();
        }
    })
})

$(function () {
    $('input[name="daterange"]').daterangepicker({
        opens: 'center'
    }, function (start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
});

$(function () {
    var cardWidth = $('.card').outerWidth(); // Get the width of one card including margin
    var scrollStep = 1; // Number of cards to scroll

    $('#forward').on('click', function () {
        var container = $('.showcase');
        var scrollPosition = container.scrollLeft() + scrollStep * cardWidth;
        container.animate({ scrollLeft: scrollPosition }, 500); // Smooth scroll animation
        toggleButtons(container);
    });

    $('#back').on('click', function () {
        var container = $('.showcase');
        var scrollPosition = container.scrollLeft() - scrollStep * cardWidth;
        container.animate({ scrollLeft: scrollPosition }, 500); // Smooth scroll animation
        toggleButtons(container);
    });
});

function toggleButtons(container) {
    var showcaseWidth = container.width();
    var totalWidth = container[0].scrollWidth;
    var currentScroll = container.scrollLeft();

    if (currentScroll >= totalWidth - showcaseWidth) {
        $('#forward').hide();
    } else {
        $('#forward').show();
    }

    if (currentScroll <= 0) {
        $('#back').hide();
    } else {
        $('#back').show();
    }
}

// Initial check for button visibility on page load
toggleButtons($('.showcase'));

let date = new Date()
let year = date.getFullYear();
document.getElementById('year').innerHTML = year;

// let countAmenity = 0
// $('#addAmenity').on('click', function (event) {
//     event.preventDefault()
//     countAmenity++
//     console.log(countAmenity)
//     $('#amenities-fields').append(
//         `<div class="row mb-2" id="amenity${countAmenity}">\
//         <div class="col-md-2">\
//         <input type="text" name="\'amenities[${countAmenity}][name]\'" class="form-control" value="{{ old('amenities[${countAmenity}][name]') }}">\
//         </div>\
//         <div class="col-md-4">\
//         <textarea name="\'amenities[${countAmenity}][description]\'" class="form-control">{{ old('amenities[${countAmenity}][name]') }}</textarea>\
//         </div>\
//         <div class="col-md-4">\
//         <input type="file" name="\'amenities[${countAmenity}][image]\'" class="form-control" value="{{ old('amenities[${countAmenity}][name]') }}">\
//         </div>\
//         <div class="col-md-2">\
//         <button class="btn btn-outline-danger" onclick="\$(\'#amenity${countAmenity}\').remove()">-</button>\
//         </div>\
//         </div>`
//     )
// })