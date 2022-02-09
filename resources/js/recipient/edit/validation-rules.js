$(() => {
    $("#edit").validate({
        rules: {
            name: {
                required: true
            },
            nip: {
                required: true,
                exactLength: 10,
                number: true,
            },
            account_number: {
                required: true,
                accountNumber: true,
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
            },
            street: {
                required: true
            },
            city: {
                required: true
            },
            post_code: {
                required: true,
            }
        }
    })
});
