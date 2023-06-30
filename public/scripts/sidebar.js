import {
    getUrl,
    pageLoader,
    headerName,
    breadCrumbs,
    getToken,
    parentContainer,
} from "./main.js";

import { loadFeesHandler } from "../app/Fee.js";

var pathname = window.location.pathname;
var name = pathname.split("/")[1];

contentLoader(name);

$(".menu-link").each(function (index, element) {
    $(element).on("click", function () {
        let url = element.id;

        contentLoader(url);
    });
});

function contentLoader(page) {
    $.ajax({
        url: "/pageLoader",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            page: page,
        },
        beforeSend: function () {
            window.history.pushState(null, null, page);
            pageLoader("open");
        },
        success: function (response) {
            view(page, response);
        },
    });
}

function loadData(url, args, page) {
    $.ajax({
        url: getUrl(url),
        type: "POST",
        data: {
            _token: getToken(),
            data: args,
        },
        beforeSend: function () {
            pageLoader("open");
        },
        success: function (view) {
            $("#" + page + "_table").html(view);
            pageLoader("close");
        },
    });
}

function view(page, response) {
    switch (page) {
        case "dashboard":
            pageLoader("close");
            headerName(page, null);
            $("#main_container").html(response);
            breadCrumbs(page, "speedometer");
            // loadData("accounts/load-data", "users_table");
            break;
        case "fees":
            loadFeesHandler(1);
            headerName(page);
            $("#main_container").html(response);
            breadCrumbs(page, "card-list");
            // loadData("accounts/load-data", "users_table");
            break;
        case "assessment":
            pageLoader("close");
            headerName(page);
            $("#main_container").html(response);
            breadCrumbs(page, "person-vcard");
            // loadData("accounts/load-data", "users_table");
            break;
        case "accounts":
            loadData("accounts/load-data", "users_table", page);
            headerName(page, "Add User");
            $("#main_container").html(response);
            breadCrumbs(page, "people");
            break;
        case "admin-students-assessment":
            headerName("Automated Assesment", null);
            $("#main_container").html(response);
            breadCrumbs("Automated Assesment", "people");
            break;
        default:
            break;
    }
}

parentContainer().on("click", "#start_btn", function (e) {
    e.preventDefault();
});
