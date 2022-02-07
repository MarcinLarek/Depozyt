$(document).ready(() => {
    $("#progressText").html("Trwa pobieranie danych...");
    $("#progressBar").removeClass("d-none");
    $("#Edit input[type='submit']").prop("disabled", true);
    $.ajax({
        type: "GET",
        dataType: "json",
        data: {},
        url: "/Client/GetData"
    }).done((response) => {
        $("#Id").val(response.id);
        $("#UserName").val(response.userName);
        $("#UserPassword").val(response.userPassword);
        $("#Email").val(response.email);
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