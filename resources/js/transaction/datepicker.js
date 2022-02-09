$(document).ready(function () {
    $("#FromDate").datepicker({
        language: 'pl-PL',
        format: 'yyyy-mm-dd',
        autoHide: true,
        autoPick: true,
        highlightedClass: "highlighted",
        startDate: Date.now()
    });
});

$(document).ready(function () {
    $("#ToDate").datepicker({
        language: 'pl-PL',
        format: 'yyyy-mm-dd',
        autoHide: true,
        autoPick: true,
        highlightedClass: "highlighted",
        startDate: Date.now()
    });
});

$(document).ready(() => {
    $("#FromDate").on("pick.datepicker", function (e) {
        if (e.date > $("#ToDate").datepicker("getDate")) {
            $("#FromDate").datepicker("setDate", $("#ToDate").datepicker("getDate"));
        }
    });
    $("#ToDate").on("pick.datepicker", function (e) {
        if (e.date < $("#FromDate").datepicker("getDate")) {
            $("#ToDate").datepicker("setDate", $("#FromDate").datepicker('getDate'));
        }
    });
});