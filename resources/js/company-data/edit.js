$(() => {
    $("#edit").on("submit", submit);
});

function submit(event) {
    event.preventDefault();
    if ($("#edit").valid()) {
        $("#progressText").html("Trwa edycja...");
        $("#progressBar").removeClass("d-none");
        $("#edit input[type='submit']").prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "/company-data/edit",
            data: $("#edit").serialize()
        })
            .done((response) => displayResponse('edit', response))
            .fail(error => displayResponse('edit', 0));
    }
}
