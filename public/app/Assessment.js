import {
    requestHandler,
    parentContainer,
    getToken,
    pageHandler,
    getToast,
    getUrl,
} from "./Main.js";

requestHandler("GET", "/assessment/get-assessment-status").then((response) => {
    const percentage = response.isassessed / 7279 * 100;
    $("#progressbar_wrapper").attr("tooltip", `${percentage.toFixed(2)}%`);
    $("#progressbar").css("width", `${percentage.toFixed(2)}%`);
});

parentContainer().on("click", "#search_student", function (e) {
    e.preventDefault();

    requestHandler("GET", "/assessment/show-search")
        .then((response) => {
            $("#main_modal").modal("show");
            $("#main_modal_body").empty().append(response.view);
        })
        .catch((err) => {
            console.log(err);
        });
});

parentContainer().on("click", "#student_search_btn", function (e) {
    e.preventDefault();

    $("#student_search_form").trigger("submit");
});

parentContainer().on("submit", "#student_search_form", function (e) {
    e.preventDefault();

    let _token = $('input[name="_token"]').val();
    let search = $('input[name="search"]').val();

    let formData = new FormData();
    formData.append("_token", _token);
    formData.append("search", search);

    requestHandler("POST", "/assessment/search", formData)
        .then((response) => {
            let output = "";

            var students = jQuery.parseJSON(response.data);

            if (response.data.length > 0) {
                students.forEach((student) => {
                    output += `<a class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                <div class="row w-100">
                                    <div class="col-8 d-flex align-items-center">
                                        <div class="symbol symbol-35px symbol-circle me-5">
                                            <img alt="Pic" src="../../assets/media/avatars/300-6.jpg">
                                        </div>
                                        <div class="fw-semibold">
                                            <span class="fs-6 text-gray-800 me-2">${student.name.toUpperCase()}</span>
                                            ${
                                                student.cabs == 1
                                                    ? `<span class="svg-icon svg-icon-1 svg-icon-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                            height="24px" viewBox="0 0 24 24">
                                                            <path
                                                                d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z"
                                                                fill="white"></path>
                                                        </svg>
                                                    </span>`
                                                    : ""
                                            }
                                            <span class="badge badge-light">${
                                                student.program
                                            }</span>
                                        </div>
                                    </div>
                                    <div class="col-4 d-flex justify-content-end">
                                       <button class="btn btn-sm btn-light assess-btn" data-id="${
                                           student.id
                                       }">
                                            <span class="indicator-label">View Assessment</span>
                                            <span class="indicator-progress">
                                                Please Wait <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </a>`;
                });
            } else {
                output = `<div data-kt-search-element="empty" class="text-center" id="users_result_empty">
                            <div class="fw-semibold py-10">
                                <div class="text-gray-600 fs-3 mb-2">No user found</div>

                                <div class="text-muted fs-6">Try to search by username, full name or email...</div>
                            </div>
                            <div class="text-center px-5">
                                <img src="../assets/media/illustrations/sketchy-1/1.png" alt="" height="180">
                            </div>
                        </div>`;
            }
            $("#students_result_container").removeClass("d-none");
            $("#students_result_wrapper").html(output);
        })
        .catch((err) => {
            console.log(err);
        });
});

parentContainer().on("click", ".assess-btn", function(e){
    e.preventDefault();

    // window.open(getUrl('assessment/stream/'+$(this).data('id')), "_blank");
    let formData = new FormData();
    formData.append("_token", getToken());
    formData.append("id", $(this).data("id"));

    $(this).attr("data-kt-indicator", "on");
    $(this).attr("disabled", true);

    sessionStorage.setItem("id", $(this).data("id"));

    pageHandler("student", $(this).data("id"));
});

parentContainer().on("click", "#save_assessment", function(e){
    e.preventDefault();

    let element = $(this);
    
    element.attr("data-kt-indicator", "on");
    element.attr("disabled", true);

    let formData = new FormData();
    formData.append("_token", getToken());
    formData.append("id", $(this).data("id"));

    requestHandler("POST", "/assessment/store", formData).then((response) => {
        getToast().fire({
            icon: "success",
            title: response.message,
        });
        element.removeAttr("data-kt-indicator");
        element
            .removeClass("btn-light")
            .addClass("btn-success");
        $(".svg-icon").removeClass("d-none");
        $(".indicator-label").text("Assessed");
        element.attr("disabled", false);

    }).catch((err) => {
        console.log(err)
    });
});

parentContainer().on("click", "#reassess", function(e){
    e.preventDefault();

    let element = $(this);

    Swal.fire({
        title: "Processing...",
        html: "Please wait...",
        allowEscapeKey: false,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();

            let formData = new FormData();
            formData.append("_token", getToken());
            formData.append("account_id", $(this).data("id"));

            element.attr("disabled", true);

            requestHandler("POST", "/assessment/reassess", formData)
                .then((response) => {
                    getToast().fire({
                        icon: "success",
                        title: response.message,
                    });
                    Swal.close()
                })
                .catch((err) => {
                    console.log(err);
                })
                .finally(() => {
                    element.attr("disabled", false);
                });
        },
    });

    
});

parentContainer().on("click", ".copy-to-clipboard", function(e){
    e.preventDefault();
    copy_to_clipboard(e);
});

function copy_to_clipboard(element)
{
    var copied = element.target.innerText;

    if (element.target.id == "student_number") {
        var sliced = copied.slice(1, 8);
        navigator.clipboard.writeText(sliced);
    } else {
        navigator.clipboard.writeText(copied);
    }

    let copySuccess = document.getElementById("copied-success");
    copySuccess.style.opacity = "1";
    setTimeout(function () {
        copySuccess.style.opacity = "0";
    }, 500);
}

parentContainer().on("click", "#generate_button", function(e){
    e.preventDefault();

    Swal.fire({
        title: "Processing...",
        html: "Please wait...",
        allowEscapeKey: false,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();

            var program_id = $("#program_select").val();
            var year_id = $("#year_select").val();

            var formData = new FormData();
            formData.append("_token", getToken());
            formData.append("program_id", program_id);
            formData.append("year_id", year_id);

            requestHandler("POST", "assessment/generate", formData)
                .then((response) => {
                    console.log(response);
                    Swal.close();
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    });
});

parentContainer().on("click", "#automate_button", async function(e){
    e.preventDefault();

    Swal.fire({
        title: "Processing...",
        html: "Please wait...",
        allowEscapeKey: false,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();

            var formData = new FormData();
            formData.append("program_id", $("#program_select").val());
            formData.append("year_id", $("#year_select").val());

            requestHandler("POST", "assessment/run-assessmenmt", formData).then((response) => {
                console.log(response);
                Swal.close();
            }).catch((err) => {
                console.log(err);
                Swal.close();
            });
        },
    });
});
