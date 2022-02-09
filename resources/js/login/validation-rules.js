$(() => {
    $("#login").validate({
        rules: {
            username: 'required',
            password: {
                required: true,
                minlength: 6
            }
        }
    });
});
