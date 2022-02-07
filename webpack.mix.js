const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

mix.combine([
    'resources/js/register/validation-rules.js',
    'resources/js/register/register.js'
], 'public/js/register.min.js').sourceMaps();

mix.combine([
    'resources/js/login/validation-rules.js',
    'resources/js/login/login.js'
], 'public/js/login.min.js').sourceMaps();

mix.combine([
    'resources/js/payment/generate-pdf.js',
    'resources/js/payment/get-amount.js',
    'resources/js/payment/get-available-amount.js',
    'resources/js/payment/get-bank.js',
    'resources/js/payment/get-currency.js',
    'resources/js/payment/get-current-amount.js',
    'resources/js/payment/get-data.js',
    'resources/js/payment/get-history.js',
], 'public/js/payment.min.js').sourceMaps();

mix.combine([
    'resources/js/representative/validation-rules.js',
    'resources/js/representative/edit.js'
], 'public/js/representative.min.js').sourceMaps();

mix.combine([
    'resources/js/client-data/edit.js'
], 'public/js/client-data.min.js').sourceMaps();

mix.combine([
    'resources/js/company-data/validation-rules.js',
    'resources/js/company-data/edit.js'
], 'public/js/company-data.min.js').sourceMaps();

mix.combine([
    'resources/js/client-bank-account/create/create.js',
    'resources/js/client-bank-account/create/validation-rules.js'
], 'public/js/client-bank-account/create.min.js');

mix.combine([
    'resources/js/client-bank-account/edit/edit.js',
    'resources/js/client-bank-account/edit/validation-rules.js',
], 'public/js/client-bank-account/edit.min.js');

mix.combine([

], 'public/js/withdrawal.min.js');

mix.combine([
    'resources/js/recipient/create/validation-rules.js',
    'resources/js/recipient/create/create.js',
], 'public/js/recipient/create.min.js');

mix.combine([
    'resources/js/recipient/edit/validation-rules.js',
    'resources/js/recipient/edit/edit.js',
], 'public/js/recipient/edit.min.js');

mix.combine([
    'resources/js/recipient/createPayment.js',
], 'public/js/recipient.min.js');

mix.combine([
    'resources/js/transaction/datepicker.js',
    'resources/js/transaction/get-list.js',
], 'public/js/transaction/list.min.js');

mix.combine([
    'resources/js/transaction/accept.js',
    'resources/js/transaction/datepicker.js',
    'resources/js/transaction/generate-pdf.js',
    'resources/js/transaction/get-bank.js',
    'resources/js/transaction/get-contractor.js',
    'resources/js/transaction/get-currency.js',
    'resources/js/transaction/get-details.js',
    'resources/js/transaction/get-payment.js',
], 'public/js/transaction/create.min.js');
