$(document).ready(() => {
    $.get("/recipient/get-history")
        .done((response) => {
            $("#history").html(response);
        })
});
