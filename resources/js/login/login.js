$(document).ready(() => {
    $("#login").on("submit", submit);
});

function submit(event) {
    event.preventDefault();
    if ($("#login").valid()) {
        $("#progressText").html("Trwa logowanie...");
        $("#progressBar").removeClass("d-none");
        $("#login input[type='submit']").prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "/sign-in/",
            data: $("#login").serialize()
        }).done((response) => {
            if (response == 1) {
                window.location.pathname = "/";
            }
            displayResponse('login', response);
        })
            .fail(error => displayResponse('login', 0));
    }
}
