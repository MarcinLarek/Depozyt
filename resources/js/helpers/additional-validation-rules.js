$.validator.addMethod("exactLength", function(value, element, exactLength) {
    return value.length === exactLength || value.length === 0;
}, "Nie poprawny format");

$.validator.addMethod("accountNumber", function(value, element) {
    let regex = /\d{26}|\d{2} \d{4} \d{4} \d{4} \d{4} \d{4} \d{4}/;
    return regex.test(value);
}, "Nie poprawny format");

$.validator.addMethod("swift", function(value, element) {
    let regex = /[A-Z]{2}\d{26}|[A-Z]{2} \d{2} \d{4} \d{4} \d{4} \d{4} \d{4} \d{4}/;
    return regex.test(value);
}, "Nie poprawny format");
