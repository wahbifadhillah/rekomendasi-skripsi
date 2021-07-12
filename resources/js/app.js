require('bootstrap');
// import 'jquery';
import $ from "jquery";
import 'bootstrap';
import bsCustomFileInput from 'bs-custom-file-input';
bsCustomFileInput.init();
$(function() {
    $('#pre-process').modal('show');
});