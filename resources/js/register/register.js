$(() => {
    $("#register").on("submit", submit);
});

function submit(event) {
    event.preventDefault();
    if ($("#register").valid()) {
        $("#progressText").html("Trwa rejestracja...");
        $("#progressBar").removeClass("d-none");
        $("#register input[type='submit']").prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "/register/store",
            data: $("#register").serialize()
        })
            .done((response) => { displayResponse('#register', response) })
            .fail(error => displayResponse('#register', 0));
    }
}
