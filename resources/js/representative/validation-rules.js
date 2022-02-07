$(() => {
    $("#edit").validate({
        rules: {
            'name': {
                required: true
            },
            'surname': {
                required: true
            },
            'pesel': {
                required: true,
                length: 11
            },
            'document_type': {
                required: true,
            },
            'document_number': {
                required: true,
            }
            'email': {
                required: true,
                email: true
            },
            'phone_number': {
                required: true,
            },
            'city': {
                required: true
            },
            'street': {
                required: true
            },
            'post_code': {
                required: true
            }
        },
        errorClass: 'text-danger',
        validClass: 'success',
        errorElement: 'span'
    });
});
