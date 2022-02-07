require('./bootstrap');
import jquery from 'jquery';
global.$ = global.jQuery = jquery;
require('@fortawesome/fontawesome-free');
require('bootstrap');
import 'jquery-ui';
import 'jquery-datepicker';


import { displayResponse } from './helpers/display-response-alert';
global.displayResponse = displayResponse;

// jQuery validation settings
import 'jquery-validation/dist/jquery.validate.min';
jQuery.validator.setDefaults({
    debug: false,
    errorClass: 'text-danger small-w-100',
    validClass: 'success',
    errorElement: 'small'
});
require('./helpers/additional-validation-rules');
