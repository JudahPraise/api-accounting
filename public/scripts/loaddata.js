import { getUrl, pageLoader } from "./main.js";

export function loadData(url, container){

    $.ajax({
        url: getUrl(url),
        type: "GET",
        beforeSend: function(){
            pageLoader("open");
        },
        success: function (response) {
            $("#" + container).html(response);
        },
    });

}