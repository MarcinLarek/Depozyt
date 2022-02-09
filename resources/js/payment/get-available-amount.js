$(document).ready(() => {
    $("#CurrencyName").change(() => {
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
    });
});