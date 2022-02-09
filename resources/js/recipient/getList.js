$(document).ready(() => {
    $.ajax({
        type: "GET",
        data: {},
        url: "/Recipient/GetList",
        dataType: "html"
    }).done((response) => {
        $("#cba-list").html(response);
    });
});