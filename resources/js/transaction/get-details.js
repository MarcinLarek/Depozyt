$(document).ready(() => {
    $("#progressText").html("Trwa pobieranie danych...");
    $("#progressBar").removeClass("d-none");
    $("#Accept input[type='submit']").prop("disabled", true);
    let url = window.location.pathname;
    let id = url.substring(url.lastIndexOf('/') + 1);
    $.ajax({
        type: "GET",
        dataType: "json",
        data: { id: id },
        url: "/Transaction/GetDetails"
    }).done((response) => {
        $("#Id").val(response.id);

        var dateOfOrder = FormatDate(response.dateOfOrder);
        $("#DateOfOrder").text(dateOfOrder);
        $("#TransactionCode").text(response.transactionCode);
        $("#Customer").text(response.customer);
        $("#Contractor").text(response.contractor);
        $("#Name").text(response.name);

        var fromDate = FormatDate(response.fromDate);
        $("#FromDate").text(fromDate);

        var toDate = FormatDate(response.toDate);
        $("#ToDate").text(toDate);

        $("#Currency").text(response.currency);

        var amount = response.amount.toFixed(2);
        amount = amount.toString().replace(".", ",");
        $("#Amount").text(amount);

        $("#Description").text(response.description);
        $("#Accept input[type='submit']").prop("disabled", false);
        $("#warningAlert").addClass("d-none");
        $("#progressBar").addClass("d-none");
    }).fail(function () {
        $("#warningAlert").removeClass("d-none");
        setTimeout(() => {
            $("#warningAlert").addClass("d-none");
        }, 10000);
        $("#progressBar").addClass("d-none");
    });
});

function FormatDate(date) {
    date = new Date(date);
    console.log(date);
    var year = date.getFullYear();
    var month = (1 + date.getMonth()).toString();
    month = month.length > 1 ? month : '0' + month;
    var day = date.getDate().toString();
    day = day.length > 1 ? day : '0' + day;
    return year + "-" + month + "-" + day;
}