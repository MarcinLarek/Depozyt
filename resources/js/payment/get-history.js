$(document).ready(() => {
    $.get("/payment/get-history")
        .done((response) => {
            $("#history").html(response);
        })
})
