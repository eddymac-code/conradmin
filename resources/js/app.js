import './bootstrap';

import '../sass/app.scss'

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