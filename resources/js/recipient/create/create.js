$(document).ready(() => {
    $("#create").on("submit", submitCreate);
});

function submitCreate(event) {
    event.preventDefault();
    if ($("#create").valid()) {
        $("#progressText").html("Trwa dodawanie...");
        $("#progressBar").removeClass("d-none");
        $("#create input[type='submit']").prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "/recipients/store",
            data: $("#create").serialize()
        })
            .done((response) => displayResponse('create', response))
            .fail(error => displayResponse('create', 0));
    }
}
