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
            regon: {
                exactLength: 9,
                number: true
            },
            krs: {
                exactLength: 10,
                number: true
            },
            email: {
                required: true,
                email: true
            },
            phone_number: {
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
