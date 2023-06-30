import {
    requestHandler,
    parentContainer,
    getToken,
    setEmptyState,
    setHeaderAction,
    getToast,
} from "./Main.js";

parentContainer().on('click', '.report_file', function(e){
    e.preventDefault();

    let formData = new FormData();
    formData.append('_token', getToken());

    requestHandler("POST", "/report/get-excel", formData).then((response) => {
        console.log(response);
    }).catch((err) => {
        console.log(err)
    });
})
