$(document).ready(() => {
    $.get("/payment/get-amount")
        .done((response) => {
            $("#amountHistory").html(response);
        })
})
