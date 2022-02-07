$(document).ready(() => {
    $("#Forgot").on("submit", submit);
});

function submit(event) {
    event.preventDefault();
    if ($("#Forgot").valid()) {
        $("#progressText").html("Trwa generowanie linku aktywacyjnego...");
        $("#progressBar").removeClass("d-none");
        $("#Forgot input[type='submit']").prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "/Client/ForgotPassword",
            data: $("#Forgot").serialize()
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
                $("#Forgot input[type='submit']").prop("disabled", false);
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