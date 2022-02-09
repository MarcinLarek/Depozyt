$(() => {
    //Declare Varables
    var documentIsValid = false;

    //Declare events
    $("#edit").on("submit", submit);
    $("#documentType").change(function (element) {
        if ($("#document-number").val().length != 0) {
            checkDocumentErrors();
        }
        changeDocumentInformation(element.target);
    });
    $("#document-number").on("paste change", function () {
        setTimeout(function () { checkDocumentErrors(); }, 100);
    });
});

function changeDocumentInformation(element) {
    if ($(element).val() === "DO")
        $("#document-number").attr("placeholder", "Nr dowodu");
    else if ($(element).val() === "PA")
        $("#document-number").attr("placeholder", "Nr paszportu");
}

function checkDocument() {
    let regexExpression;
    if ($("#DocumentType").val() === "DO")
        regexExpression = "^[A-Z]{3}[0-9]{6}$";
    else if ($("#DocumentType").val() === "PA")
        regexExpression = "^(?!^0+$)[A-Z0-9]{6,9}$";
    regexExpression = new RegExp(regexExpression);

    if (regexExpression.test($("#document-number").val()))
        return true;
    return false;
}

function checkDocumentErrors() {
    let errorMessageElement = $("#errorMessageFordocument-number");
    if (checkDocument() !== true) {
        documentIsValid = false;
        errorMessageElement.text("Nieprawidłowy nr dokumentu");
    }
    else {
        documentIsValid = true;
        errorMessageElement.text("");
    }
}

function submit(event) {
    event.preventDefault();
    checkDocumentErrors();
    if ($("#document-number").val().length == 0) {
        $("#errorMessageForDocumentNumber").text("Wymagane pole.");
    }
    if (documentIsValid) {
        // if ($("#edit").valid()) {
        $("#progressText").html("Trwa edycja...");
        $("#progressBar").removeClass("d-none");
        $("#edit input[type='submit']").prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "/client-data/edit",
            data: $("#edit").serialize()
        }).done((response) => {
            if (response == 1) {
                $("#invalidAlert").addClass("d-none");
                $("#successAlert").removeClass("d-none");
                setTimeout(() => {
                    $("#successAlert").addClass("d-none");
                }, 5000);
                $("#edit input[type='submit']").prop("disabled", false);
                $("#progressBar").addClass("d-none");
            }
            else {
                $("#edit input[type='submit']").prop("disabled", false);
                $("#progressBar").addClass("d-none");
                $("#invalidAlert").removeClass("d-none");
                $("#successAlert").addClass("d-none");
                setTimeout(() => {
                    $("#invalidAlert").addClass("d-none");
                }, 5000);
            }
        });
        // }
    }
}
