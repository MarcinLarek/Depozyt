$(document).ready(() => {
    $.ajax({
        type: "GET",
        data: {},
        url: "/ClientBankAccount/GetList",
        dataType: "html"
    }).done((response) => {
        $("#cba-list").html(response);
    });
});