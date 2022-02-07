$(document).ready(() => {
    $("#progressText").html("Trwa pobieranie danych...");
    $("#progressBar").removeClass("d-none");
    $("#Edit input[type='submit']").prop("disabled", true);
    let url = window.location.pathname;
    let id = url.substring(url.lastIndexOf('/') + 1);
    $.ajax({
        type: "GET",
        dataType: "json",
        data: {},
        url: "/ClientBankAccount/GetCurrency"
    }).done((response) => {
        $.each(response, index => {
            $("#CurrencyName").append(`<option value="${response[index].symbol}">${response[index].symbol} - ${response[index].name}</option>`);
        });
    }).done(() => {
        $.ajax({
            type: "GET",
            dataType: "json",
            data: { id: id },
            url: "/ClientBankAccount/GetData"
        }).done((response) => {
            $("#Id").val(response.id);
            $("#Name").text(response.name);
            $("#BankName").val(response.bankName);
            $("#CurrencyName").val(response.currencyName);
            $("#Number").val(response.number);
            $("#countryValue").text(response.country);
            $("#Country").attr("value", response.country);
            $("#NumberSwift").val(response.numberSwift);
            $("#Active").val(response.active.toString());
            $("#Edit input[type='submit']").prop("disabled", false);
            $("#warningAlert").addClass("d-none");
            $("#progressBar").addClass("d-none");
        }).fail(function () {
            $("#warningAlert").removeClass("d-none");
            setTimeout(() => {
                $("#warningAlert").addClass("d-none");
            }, 10000);
        });
    });
});