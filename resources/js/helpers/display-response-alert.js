/**
 *
 * @param {string} formId form id
 * @param {number} response http response from api 1 - true, 0 - false
 */
export function displayResponse(formId, response) {
    if (response == 1) {
    console.log(`#${formId} #successAlert`);
        $(`#${formId} #invalidAlert`).addClass("d-none");
        $(`#${formId} #successAlert`).removeClass("d-none");
        setTimeout(() => {
            $(`#${formId} #successAlert`).addClass("d-none");
        }, 5000);
        $(`#${formId} input[type='submit']`).prop("disabled", false);
        $(`#${formId} #progressBar`).addClass("d-none");
    } else {
        $(`#${formId} input[type='submit']`).prop("disabled", false);
        $(`#${formId} #progressBar`).addClass("d-none");
        $(`#${formId} #invalidAlert`).removeClass("d-none");
        $(`#${formId} #successAlert`).addClass("d-none");
        setTimeout(() => {
            $(`#${formId} #invalidAlert`).addClass("d-none");
        }, 5000);
    }
}
