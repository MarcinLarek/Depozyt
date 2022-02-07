$(document).ready(() => {
    $.ajax({
        type: "GET",
        data: $("form#list-filters").serialize(),
        url: "/transactions/get-list",
        dataType: "html"
    }).done((response) => {
        $("#tran-list").html(response);
    }).always(() => {
        $("#pre-loader").fadeOut("slow");
    });
});

$(document).ready(() => {
    $("#ClientType").change(() => {
        $("#pre-loader").fadeIn("fast");
        $("#text-loader").html("Wyszukiwanie danych.");
        $.ajax({
            type: "GET",
            data: $("form#list-filters").serialize(),
            url: "/transaction/get-list",
            dataType: "html"
        }).done((response) => {
            $("#tran-list").html(response);
        }).always(() => {
            $("#pre-loader").fadeOut("slow");
        });
    });
});

$(document).ready(() => {
    $("#FromDate").change(() => {
        $("#pre-loader").fadeIn("fast");
        $("#text-loader").html("Wyszukiwanie danych.");
        $.ajax({
            type: "POST",
            data: $("form#list-filters").serialize(),
            url: "/Transaction/GetList",
            dataType: "html"
        }).done((response) => {
            $("#tran-list").html(response);
        }).always(() => {
            $("#pre-loader").fadeOut("slow");
        });
    });
});

$(document).ready(() => {
    $("#ToDate").change(() => {
        $("#pre-loader").fadeIn("fast");
        $("#text-loader").html("Wyszukiwanie danych.");
        $.ajax({
            type: "POST",
            data: $("form#list-filters").serialize(),
            url: "/Transaction/GetList",
            dataType: "html"
        }).done((response) => {
            $("#tran-list").html(response);
        }).always(() => {
            $("#pre-loader").fadeOut("slow");
        });
    });
});

$(document).ready(() => {
    $("#Expression").keyup(() => {
        $("#pre-loader").fadeIn("fast");
        $("#text-loader").html("Wyszukiwanie danych.");
        $.ajax({
            type: "POST",
            data: $("form#list-filters").serialize(),
            url: "/Transaction/GetList",
            dataType: "html"
        }).done((response) => {
            $("#tran-list").html(response);
        }).always(() => {
            $("#pre-loader").fadeOut("slow");
        });
    });
});
