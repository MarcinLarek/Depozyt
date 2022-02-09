$(document).ready(() => {
    $.get("/Withdrawal/getHistory")
        .done((response) => {
            $("#history").html(response);
        })
})