import {
    requestHandler,
    parentContainer,
    getToken,
    setEmptyState,
    setHeaderAction,
    getToast,
} from "./Main.js";


export function loadFeesHandler(type) {
    var formData = new FormData();
    formData.append("data", type);

    requestHandler("POST", "/fees", formData)
        .then((response) => {
            let output = "";
            response.data.forEach((fee) => {
                switch (response.type) {
                    case 1:
                        output += `<tr>
                            <td class="">${fee.description_text}</td>
                            <td class="text-center">${fee.account_type_text}</td>
                            <td class="text-center"><span>&#8369;</span>${fee.cost}</td>
                            <td class="text-center">${fee.reference_number}</td>
                            <td class="text-center">${fee.date_of_approval}</td>
                            ${
                                response.user_role == 1 ?
                                `<td class="text-end">
                                    <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm mb-1 fee-edit-btn"
                                        data-id="${fee.id_key}" data-type="${fee.type}">
                                        <span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3"
                                                    d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm mb-1 fee-delete-btn"
                                        data-id="${fee.id_key}" data-type="${fee.type}">
                                        <span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                    fill="currentColor"></path>
                                                <path opacity="0.5"
                                                    d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                    fill="currentColor"></path>
                                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </a>
                                </td>` : ''
                            }
                        </tr>`;
                        break;

                    case 2:
                        output += `<tr>
                            <td class="">${fee.description_text}</td>
                            <td class="text-center">${fee.account_type_text}</td>
                            <td class="text-center"><span>&#8369;</span>${fee.cost}</td>
                            <td class="text-center">${fee.reference_number}</td>
                            <td class="text-center">${fee.date_of_approval}</td>
                            ${
                                response.user_role == 1 ?
                                `<td class="text-end">
                                    <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm mb-1 fee-edit-btn"
                                        data-id="${fee.id_key}" data-type="${fee.type}">
                                        <span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3"
                                                    d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm mb-1 fee-delete-btn"
                                        data-id="${fee.id_key}" data-type="${fee.type}">
                                        <span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                    fill="currentColor"></path>
                                                <path opacity="0.5"
                                                    d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                    fill="currentColor"></path>
                                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </a>
                                </td>` : ''
                            }
                        </tr>`;
                        break;
                }
            });

            handleSearchState(response.type);
            handleFilterState(type);
            
            if(response.user_role == 1){
                setHeaderAction(
                `<a class="btn btn-primary" id="add_fee_modal_btn">Add Fee</a>`
                );
            }

            if (response.data.length > 0) {
                $("#fees_empty_state").hide();
                $("#fees_table").show();
                $("#fees_table > tbody").empty().append(output);
            } else {
                let empty_state = "";

                if (response.type == 1) {
                    empty_state = setEmptyState(
                        "../assets/media/illustrations/sketchy-1/16.png",
                        "Add New Student Fee",
                        "Encode student fees i.e. Student Assessment, <br>Adding and Changing of Courses, Graduation Fee etc."
                    );
                } else {
                    empty_state = setEmptyState(
                        "../assets/media/illustrations/sketchy-1/16.png",
                        "Add New Fee",
                        "Encode other fees i.e. Faculty fee, Rental fee etc."
                    );
                }
                $("#fees_table").hide();
                $("#fees_empty_state").show().empty().append(empty_state);
            }
        })
        .catch((err) => console.log(err));
}

parentContainer().on("change", "#fees_filter_select", function () {
    loadFeesHandler($(this).val());
});

parentContainer().on("click", ".fee-edit-btn", function (e) {
    e.preventDefault();

    let formData = new FormData();
    formData.append("id", $(this).data("id"));
    formData.append("type", $(this).data("type"));

    requestHandler("POST", "/fees/edit", formData)
        .then((response) => {
            $("#main_modal").modal("show");
            $("#main_modal_body").empty().append(response.view);
            $("#type_wizard_page").empty().append(response.form);
        })
        .catch((err) => {
            getToast().fire({
                icon: "error",
                title: "An error occured!",
            });
        });
});

parentContainer().on("click", ".fee-delete-btn", function (e) {
    e.preventDefault();

    var formData = new FormData();
    formData.append("_token", getToken());
    formData.append("id", $(this).data("id"));

    requestHandler("POST", "/fees/delete", formData)
        .then((response) => {
            getToast().fire({
                icon: "success",
                title: response.message,
            });
            loadFeesHandler(response.type);
            $(this).parent().parent().remove();
        })
        .catch((err) => console.log(err));
});

parentContainer().keyup("#search_fee", function () {
    search_table($("#search_fee").val());
});

$(document).on("click", '#add_fee_modal_btn', function (e) {
    e.preventDefault();
    requestHandler("GET", "/fees/create")
        .then((response) => {
            $("#main_modal").modal("show");
            $("#main_modal_body").empty().append(response.view);
        })
        .catch((error) => {
            getToast().fire({
                icon: "error",
                title: "An error occured!",
            });
        });
});

parentContainer().on("click", 'input[name="account_type"]', function (e) {
    e.preventDefault();

    let formData = new FormData();
    formData.append("_token", getToken());
    formData.append("type", $(this).val());

    requestHandler("POST", "/fees/select-type", formData)
        .then((response) => {
            $("#type_wizard_page").empty().append(response.view);
        })
        .catch((err) => {
            getToast().fire({
                icon: "error",
                title: "An error occured!",
            });
        });
});

// If selected fee type is tuition fee add another field for is_nstp fee
parentContainer().on("change", "#fee_type_id", function(e){
    if($(this).val() == 1){
        var html = `<label class="required fw-semibold fs-6 mb-5">Is NSTP Fee</label>
                    <div class="d-flex flex-column fv-row">
                        <div class="form-check form-check-custom form-check-solid mb-5">
                            <input class="form-check-input me-3" name="is_nstp" type="radio" value="1"
                                id="kt_docs_formvalidation_radio_option_1"/>
                            <label class="form-check-label" for="kt_docs_formvalidation_radio_option_1">
                                <div class="fw-semibold text-gray-800">Yes</div>
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mb-5">
                            <input class="form-check-input me-3" name="is_nstp" type="radio" value="0"
                                id="kt_docs_formvalidation_radio_option_2"/>
                            <label class="form-check-label" for="kt_docs_formvalidation_radio_option_2">
                                <div class="fw-semibold text-gray-800">No</div>
                            </label>
                        </div>
                    </div>`;
        $("#is_nstp_container").html(html);
    }
});

parentContainer().on("click", "#wizard_btn_confirm", function (e) {
    e.preventDefault();

    let url;
    let form_id = $(this).parent().parent()[0].id;
    let form = document.getElementById(form_id);
    let formData = new FormData(form);
    formData.append("id", $(this).parent().parent()[0].dataset.id);

    if (form_id == "new_fee_form") {
        url = "/fees/store";
    } else {
        url = "/fees/update";
    }
    requestHandler("POST", "/fees/validate-request", formData)
        .then((response) => {
            if (response.status == 200) {
                requestHandler("POST", url, formData)
                    .then((response) => {
                        getToast().fire({
                            icon: "success",
                            title: response.message,
                        });
                        $("#main_modal").modal("hide");
                        loadFeesHandler(formData.get("type"));
                    })
                    .catch((err) => {
                        getToast().fire({
                            icon: "error",
                            title: "An error occured!",
                        });
                    });
            } else {
                $.each(response.errors, function (prefix, val) {
                    $(document)
                        .find(".error-text." + prefix + "-error")
                        .text(val);
                });
            }
        })
        .catch((err) => {
            getToast().fire({
                icon: "error",
                title: "An error occured!",
            });
        });
});

function search_table(value) {
    $("tbody tr").each(function () {
        var found = "false";
        $(this).each(function () {
            if (
                $(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0
            ) {
                found = "true";
            }
        });
        if (found == "true") {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

function handleSearchState(type) {
    switch (type) {
        case 2:
            $("#search_fee").attr("placeholder", "Search Other Fee");
            sessionStorage.setItem("fees_type", type);
            break;
        case 1:
            $("#search_fee").attr("placeholder", "Search Assessment Fee");
            sessionStorage.setItem("fees_type", type);
            break;
    }
}

function handleFilterState(type) {
    const html = `<option value="1" ${
        type == 1 ? "selected" : ""
    }>Assessment</option>
                    <option value="2" ${
                        type == 2 ? "selected" : ""
                    }>Others</option>`;

    $("#fees_filter_select").html(html);
}
