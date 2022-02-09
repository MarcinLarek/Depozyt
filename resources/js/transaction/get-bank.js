$(document).ready(() => {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: {},
        url: "/PlatformBankAccount/GetBank"
    }).done((response) => {
        $.each(response, index => {
            $("#BankName").append(`<option value="${response[index].name}">${response[index].name}</option>`);
        });
        let bankName = $("#BankName").val();
        $.ajax({
            type: "GET",
            dataType: "json",
            data: { bankName: bankName },
            url: "/PlatformBankAccount/GetCurrency"
        }).done((response) => {
            $.each(response, index => {
                $("#CurrencyName").append(`<option value="${response[index].symbol}">${response[index].symbol} - ${response[index].name}</option>`);
            });
        });
    });
});