import { getUrl } from "./main.js";

export function cashierUserTable(tbl) {
    var table;

    $.fn.dataTable.Api.register("column().title()", function () {
        return $(this.header()).text().trim();
    });

    $.fn.dataTable.ext.errMode = "throw";

    $("#" + tbl).DataTable().clear().destroy();
    table = $("#" + tbl).DataTable({
        responsive: true,
        filter: true,
        processing: true,
        serverSide: true,
        order: [[0, "desc"]],
        language: {
            emptyTable: "No Users Available",
        },
        ajax: {
            url: getUrl("accounts/employee-table"),
            type: "GET",
        },
        columns: [
            { data: "p_id", visible: false },
            { data: "fullname", orderable: false },
            { data: "role" },
            { data: "status" },
        ],
    });
}
