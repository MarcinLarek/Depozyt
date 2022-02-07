$(document).ready(() => {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: {},
        url: "/Recipient/GetRecipients"
    }).done((response) => {
        if (response != null) {
            $.each(response, index => {
                $("#Name").append(`<option value="${response[index].name}">${response[index].name}</option>`);
            });
            $.ajax({
                type: "POST",
                data: $("#Search").serialize(),
                url: "/Recipient/GetDataRecipient",
                dataType: "html"
            }).done((response) => {
                $("#payment").html(response);
                $("#Id").val($("#IdRecipient").val());
                $("#PaymentTitle").val("");
                $("#Amount").val("");
                $("#progressBar").addClass("d-none");
                $.ajax({
                    type: "GET",
                    data: {},
                    url: "/Recipient/GetCurrency",
                    dataType: "json"
                }).done((response) => {
                    if (response != null) {
                        $.each(response, index => {
                            $("#CurrencyName").append(`<option value="${response[index].currencyName}">${response[index].currencyName}</option>`);
                        });
                    }
                });
            });
        }
        else {
            //$("#warningAlert").removeClass("d-none");
            //$("#withdrawal").addClass("d-none");
        }
    });
    $("#Name").change(() => {
        let name = $("#Name").val();
        $("#progressBar").removeClass("d-none");
        $.ajax({
            type: "POST",
            data: $("#Search").serialize(),
            url: "/Recipient/GetDataRecipient",
            dataType: "html"
        }).done((response) => {
            $("#payment").html(response);
            $("#Id").val($("#IdRecipient").val());
            $("#PaymentTitle").val("");
            $("#Amount").val("");
            $("#progressBar").addClass("d-none");
            $.ajax({
                type: "GET",
                data: {},
                url: "/Recipient/GetCurrency",
                dataType: "json"
            }).done((response) => {
                if (response != null) {
                    $("#CurrencyName").html("");
                    $.each(response, index => {
                        $("#CurrencyName").append(`<option value="${response[index].currencyName}">${response[index].currencyName}</option>`);
                    });
                }
            });
        });
    });
});