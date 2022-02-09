$(document).ready(() => {
    $("#Reset").on("submit", submit);
});

function submit(event) {
    event.preventDefault();
    if ($("#Reset").valid()) {
        $("#progressText").html("Trwa edycja danych...");
        $("#progressBar").removeClass("d-none");
        $("#Reset input[type='submit']").prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "/Client/ResetPassword",
            data: $("#Reset").serialize()
        }).done((response) => {
            if (response == 1) {
                $("#invalidAlert").addClass("d-none");
                $("#successAlert").removeClass("d-none");
                setTimeout(() => {
                    $("#successAlert").addClass("d-none");
                }, 5000);
                $("#progressBar").addClass("d-none");
            }
            else {
                $("#Reset input[type='submit']").prop("disabled", false);
                $("#progressBar").addClass("d-none");
                $("#invalidAlert").removeClass("d-none");
                $("#successAlert").addClass("d-none");
                setTimeout(() => {
                    $("#invalidAlert").addClass("d-none");
                }, 5000);
            }
        });
    }
}