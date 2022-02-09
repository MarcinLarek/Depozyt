$(document).ready(() => {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: {},
        url: "/ClientBankAccount/GetCurrency"
    }).done((response) => {
        $.each(response, index => {
            $("#CurrencyName").append(`<option value="${response[index].symbol}">${response[index].symbol} - ${response[index].name}</option>`);
        });
    });
});