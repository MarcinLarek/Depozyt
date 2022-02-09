$(document).ready(() => {
    $("#BankName").change(() => {
        let bankName = $("#BankName").val();
        $.ajax({
            type: "GET",
            dataType: "json",
            data: { bankName: bankName },
            url: "/PlatformBankAccount/GetCurrency"
        }).done((response) => {
            $("#CurrencyName").empty();
            $.each(response, index => {
                $("#CurrencyName").append(`<option value="${response[index].symbol}">${response[index].symbol} - ${response[index].name}</option>`);
            });
        });
    });
});