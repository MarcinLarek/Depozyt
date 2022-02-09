$(document).ready(() => {
    $("#CurrencyName").change(() => {
        $("#Search #progressText").html("Trwa wyszukiwanie...");
        $("#Search #progressBar").removeClass("d-none");
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