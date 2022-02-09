$(document).ready(() => {
    $("#Pay").on("submit", submit);
});

function submit(event) {
    event.preventDefault();
    $("#progressText").html("Trwa akceptacja...");
    $("#progressBar").removeClass("d-none");
    $("#Accept input[type='submit']").prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "/Transaction/Pay",
        data: $("#Pay").serialize()
    }).done((response) => {
        if (response == 1) {
            $("#progressBar").addClass("d-none");
            $("#invalidAlert").addClass("d-none");
            $("#successAlert").removeClass("d-none");
            setTimeout(() => {
                $("#successAlert").addClass("d-none");
            }, 5000);
        }
        else {
            $("#Pay input[type='submit']").prop("disabled", false);
            $("#progressBar").addClass("d-none");
            $("#invalidAlert").removeClass("d-none");
            $("#successAlert").addClass("d-none");
            setTimeout(() => {
                $("#invalidAlert").addClass("d-none");
            }, 5000);
        }
    });
}