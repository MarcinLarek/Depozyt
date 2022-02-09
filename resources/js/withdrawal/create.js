$(document).ready(() => {
    $("#Create").on("submit", submit);
});

function submit(event) {
    event.preventDefault();
    if ($("#Create").valid()) {
        $("#progressText").html("Trwa dodawanie...");
        $("#progressBar").removeClass("d-none");
        $("#Create input[type='submit']").prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "/Withdrawal/Create",
            data: $("#Create").serialize()
        }).done((response) => {
            if (response == 1) {
                $("#Create input[type='submit']").prop("disabled", false);
                $("#progressBar").addClass("d-none");
                $("#invalidAlert").addClass("d-none");
                $("#successAlert").removeClass("d-none");
                setTimeout(() => {
                    $("#successAlert").addClass("d-none");
                }, 5000);

                let currencyName = $("#CurrencyName").val();

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    data: { currencyName: currencyName },
                    url: "/Wallet/GetAvailableAmount"
                }).done((response) => {
                    $("#AvailableAmount").text(response);

                    if (response == "0,00") {
                        $("#Create input[type='submit']").prop("disabled", true);
                    }
                    else {
                        $("#Create input[type='submit']").prop("disabled", false);
                    }
                });
            }
            else {
                $("#Create input[type='submit']").prop("disabled", false);
                $("#progressBar").addClass("d-none");
                $("#invalidAlert").removeClass("d-none");
                $("#successAlert").addClass("d-none");
                setTimeout(() => {
                    $("#invalidAlert").addClass("d-none");
                }, 5000);
            }
        }).always(() => {
            $("#Name").val("");
            $("#Amount").val("");
        });
    }
}