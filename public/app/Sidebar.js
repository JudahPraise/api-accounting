import { pageHandler, setHeaderAction } from "./Main.js";
import { loadFeesHandler } from "./Fee.js";

$(".menu-link").on("click", function (e) {
    e.preventDefault();
    loadPage($(this).data("page")).then(
        handlePageData($(this).data("page"))
    );
});

async function loadPage(page) {
    pageHandler(page);
}

function handlePageData(page) {
    switch (page) {
        case "fees":
            loadFeesHandler(
                `${
                    sessionStorage.getItem("fees_type")
                        ? sessionStorage.getItem("fees_type")
                        : 1
                }`
            );
            break;
        default:
            setHeaderAction();
            break;
    }
}

handleRefresh();

function handleRefresh() {
    var pathname = window.location.pathname;
    var page = pathname.split("/")[1];
    

    loadPage(page).then(handlePageData(page));

}