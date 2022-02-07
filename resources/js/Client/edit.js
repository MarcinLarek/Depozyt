$(document).ready(() => {
    $("#Edit").on("submit", submit);
});

function submit(event) {
    event.preventDefault();
    if ($("#Edit").valid()) {
        $("#progressText").html("Trwa edycja...");
        $("#progressBar").removeClass("d-none");
        $("#Edit input[type='submit']").prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "/Client/Edit",
            data: $("#Edit").serialize()
        }).done((response) => {
            if (response == 1) {
                window.location.href = '/Login/Logout/';
            }
            else {
                $("#Edit input[type='submit']").prop("disabled", false);
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