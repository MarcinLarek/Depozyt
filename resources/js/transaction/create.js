$(document).ready(() => {
    $("#Create").on("submit", submit);
});

function submit(event) {
    event.preventDefault();
    if ($("#Create").valid()) {
        $("#Create #progressText").html("Trwa dodawanie...");
        $("#Create #progressBar").removeClass("d-none");
        $("#Create input[type='submit']").prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "/Transaction/Create",
            data: $("#Create").serialize()
        }).done((response) => {
            if (response == 1) {
                $("#Create input[type='submit']").prop("disabled", false);
                $("#Create #progressBar").addClass("d-none");
                $("#invalidAlert").addClass("d-none");
                $("#successAlert").removeClass("d-none");
                setTimeout(() => {
                    $("#successAlert").addClass("d-none");
                }, 5000);
            }
            else {
                $("#Create input[type='submit']").prop("disabled", false);
                $("#Create #progressBar").addClass("d-none");
                $("#invalidAlert").removeClass("d-none");
                $("#successAlert").addClass("d-none");
                setTimeout(() => {
                    $("#invalidAlert").addClass("d-none");
                }, 5000);
            }
        });
    }
}