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