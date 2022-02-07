$(document).ready(() => {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: {},
        url: "/ClientBankAccount/GetBank"
    }).done((response) => {
        $.each(response, index => {
            $("#BankName").append(`<option value="${response[index].name}">${response[index].name}</option>`);
        });
    });
});