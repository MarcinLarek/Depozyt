$(document).ready(() => {
    $("#progressText").html("Trwa pobieranie danych...");
    $("#progressBar").removeClass("d-none");
    $("#Edit input[type='submit']").prop("disabled", true);
    let url = window.location.pathname;
    let id = url.substring(url.lastIndexOf('/') + 1);
        $.ajax({
            type: "GET",
            dataType: "json",
            data: { id: id },
            url: "/Recipient/GetData"
        }).done((response) => {
            $("#Id").val(response.id);
            $("#Name").val(response.name);
            $("#Nip").val(response.nip);
            $("#AccountNumber").val(response.accountNumber);
            $("#countryValue").text(response.country);
            $("#Country").attr("value", response.country);
            $("#Email").val(response.email);
            $("#PhoneNumber").val(response.phoneNumber);
            $("#Street").val(response.street);
            $("#PostCode").val(response.postCode);
            $("#City").val(response.city);
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