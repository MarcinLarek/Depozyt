function generatePdf(transactionCode) {
    $("#generatingPDF").removeClass("d-none");
    $.get(`/Transaction/generatepdf/${transactionCode}`)
        .done((Response) => {
            var link = document.createElement("a");
            link.download = Response;
            link.href = Response;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            delete link;
            $("#generatingPDF").text("Pobieranie...");
            setTimeout(function () {
                $("#generatingPDF").addClass("d-none");
                $("#generatingPDF").text("Generowanie PDF...");
            }, 4000);
        })
        .fail((error) => {
            console.error(error);
        });
   
}