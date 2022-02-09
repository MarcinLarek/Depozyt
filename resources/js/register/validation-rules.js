$(() => {
    $('#register').validate({
        rules: {
            username: {
                required: true,
            },
            password: {
                required: true,
                minlength: 6,
            },
            'compare-password': {
                required: true,
                minlength: 6,
                comparePasswords: 'password'
            },
            email: {
                required: true,
                email: true
            }
        }
    })
});

$.validator.addMethod("comparePasswords", function(value, element) {
    return $("#password").val() === value;
}, "Wprowadź te same hasła");
