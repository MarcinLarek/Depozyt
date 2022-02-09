$(document).ready(() => {
    $("#PayRecipient").on("submit", submit);
});

function submit(event) {
    event.preventDefault();
    if ($("#PayRecipient").valid()) {
        $("#progressText").html("Trwa dodawanie...");
        $("#progressBar").removeClass("d-none");
        $("#PayRecipient input[type='submit']").prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "/Recipient/CreatePayment",
            data: $("#PayRecipient").serialize()
        }).done((response) => {
            if (response == 1) {
                $("#progressBar").addClass("d-none");
                $("#PayRecipient input[type='submit']").prop("disabled", false);
                $("#invalidAlert").addClass("d-none");
                $("#successAlert").removeClass("d-none");
                setTimeout(() => {
                    $("#successAlert").addClass("d-none");
                }, 5000);

                $("#PaymentTitle").val("");
                $("#Amount").val("");
            }
            else {
                $("#progressBar").addClass("d-none");
                $("#PayRecipient input[type='submit']").prop("disabled", false);
                $("#invalidAlert").removeClass("d-none");
                $("#successAlert").addClass("d-none");
                setTimeout(() => {
                    $("#invalidAlert").addClass("d-none");
                }, 5000);
            }
        });
    }
}