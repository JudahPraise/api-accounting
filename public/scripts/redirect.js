import {
    getUrl,
    parentContainer,
    showAlert,
    getToken,
    callModal,
    sendRequest,
    handleFormData,
} from "./main.js";

export function redirectTo(page, id) {
    $.ajax({
        url: "/set-page",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            page: page,
            id: id,
        },
        beforeSend: function () {
            window.history.pushState(null, null, page);
            // pageLoader("open");
        },
        success: function (data) {
            console.log(data);
            parentContainer(data);
            // console.log(page, id)
        },
    });
}
