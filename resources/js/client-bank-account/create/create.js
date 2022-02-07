$(document).ready(() => {
    $("#create").on("submit", submit);
});

function submit(event) {
    event.preventDefault();
    if ($("#create").valid()) {
        $("#progressText").html("Trwa dodawanie...");
        $("#progressBar").removeClass("d-none");
        $("#create input[type='submit']").prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "/bank-accounts/store",
            data: $("#create").serialize()
        })
            .done((response) => displayResponse('create', response))
            .fail(error => displayResponse('create', 0));
    }
}
