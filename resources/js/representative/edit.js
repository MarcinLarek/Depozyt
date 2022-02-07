$(() => {
    let documentIsValid = false;
    //Declare events
    $("#edit").on("submit", submit);
    $("#DocumentType").change(function (element) {
        if ($("#document-number").val().length != 0) {
            checkDocumentErrors();
        }
        changeDocumentInformation(element.target);
    });
    $("#document-number").on("paste change", function () {
        setTimeout(function () {
            checkDocumentErrors();
        }, 100);
    });

    function changeDocumentInformation(element) {
        if ($(element).val() === "ID Card") {
            $("#document-number").attr("placeholder", "Nr dowodu");
        } else if ($(element).val() === "Passport") {
            $("#document-number").attr("placeholder", "Nr paszportu");
        }
    }

    function checkDocument() {
        let regexExpression;
        let isValid = false;
        if ($("#document-type").val() === "DO")
            regexExpression = "^[A-Z]{3}[0-9]{6}$";
        else if ($("#DocumentType").val() === "PA")
            regexExpression = "^(?!^0+$)[A-Z0-9]{6,9}$";
        regexExpression = new RegExp(regexExpression);

        if (regexExpression.test($("#document-number").val())) {
            isValid = true;
        }
        return isValid;
    }

    function checkDocumentErrors() {
        let errorMessageElement = $("#errorMessageForDocumentNumber");
        if (checkDocument() !== true) {
            documentIsValid = false;
            errorMessageElement.text("Nieprawidłowy nr dokumentu");
        } else {
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
            if ($("#edit").valid()) {
                $("#progressText").html("Trwa edycja...");
                $("#progressBar").removeClass("d-none");
                $("#edit input[type='submit']").prop("disabled", true);
                $.ajax({
                    type: "POST",
                    url: "/representative/edit",
                    data: $("#edit").serialize()
                }).done((response) => displayResponse('#edit', response));
            }
        }
    }
});
