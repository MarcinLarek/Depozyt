$(() => {
    $("#search #personal-code").keyup(() => {
        let personalCode = $("#personal-code").val();
        if (personalCode.length > 4) {
            $("#search #progressText").html("Trwa wyszukiwanie...");
            $("#search #progressBar").removeClass("d-none");
            $.ajax({
                type: "POST",
                data: $("#search").serialize(),
                url: "/transactions/get-contractor",
                dataType: "html"
            }).done((response) => {
                $("#contractor").html(response);
                $("#search #progressBar").addClass("d-none");
            });
        }
        else {
            $("#contractor").empty();
            $("#search #progressBar").addClass("d-none");
        }
    });
});
