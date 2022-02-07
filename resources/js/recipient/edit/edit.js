$(() => {
    $("#edit").on("submit", updateData);
});

function updateData(event) {
    event.preventDefault();
    if ($("#edit").valid()) {
        $("#progressText").html("Trwa edycja...");
        $("#progressBar").removeClass("d-none");
        $("#edit input[type='submit']").prop("disabled", true);
        let recipientId = $('#edit #recipient-id').val();
        $.ajax({
            type: "PUT",
            url: `/recipients/${recipientId}/update`,
            data: $("#edit").serialize()
        })
            .done((response) => displayResponse('edit', response))
            .fail((error) => displayResponse('edit', 0));
    }
}
