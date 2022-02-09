$(document).ready(() => {
    $("#edit").on("submit", editBankAccount);
});

function editBankAccount(event) {
    event.preventDefault();
    // if ($("#edit").valid()) {
        $("#progressText").html("Trwa edycja...");
        $("#progressBar").removeClass("d-none");
        $("#edit input[type='submit']").prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "/bank-account/1/edit/",
            data: $("#edit").serialize()
        }).done((response) => {
            if (response == 1) {
                $("#invalidAlert").addClass("d-none");
                $("#successAlert").removeClass("d-none");
                setTimeout(() => {
                    $("#successAlert").addClass("d-none");
                }, 5000);
                $("#edit input[type='submit']").prop("disabled", false);
                $("#progressBar").addClass("d-none");
            }
            else {
                $("#edit input[type='submit']").prop("disabled", false);
                $("#progressBar").addClass("d-none");
                $("#invalidAlert").removeClass("d-none");
                $("#successAlert").addClass("d-none");
                setTimeout(() => {
                    $("#invalidAlert").addClass("d-none");
                }, 5000);
            }
        });
    // }
}
