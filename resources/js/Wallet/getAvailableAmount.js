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
        });
    });
});