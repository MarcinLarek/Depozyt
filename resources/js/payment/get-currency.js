$(document).ready(() => {
    $("#BankName").change(() => {
        let bankName = $("#BankName").val();
        $.ajax({
            type: "GET",
            dataType: "json",
            data: { bankName: bankName },
            url: "/Payment/GetCurrency"
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
                $.ajax({
                    type: "POST",
                    data: $("#Search").serialize(),
                    url: "/Payment/GetData",
                    dataType: "html"
                }).done((response) => {
                    $("#payment").html(response);
                    $("#progressBar").addClass("d-none");
                });
            });
        });
    });
});