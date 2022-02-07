$(document).ready(() => {
    $("#BankName").change(() => {
        let bankName = $("#BankName").val();
        $.ajax({
            type: "GET",
            dataType: "json",
            data: { bankName: bankName },
            url: "/Wallet/GetCurrency"
        }).done((response) => {
            $("#CurrencyName").empty();
            $.each(response, index => {
                $("#CurrencyName").append(`<option value="${response[index].symbol}">${response[index].symbol} - ${response[index].name}</option>`);
            });
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
});