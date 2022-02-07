$(() => {
    $("#create").validate({
        rules: {
            name: {
                required: true
            },
            bank_name: {
                required: true
            },
            currency_id: {
                required: true
            },
            account_number: {
                required: true,
                accountNumber: true,
            },
            swift: {
                required: true,
                swift: true
            }
        }
    });
});
