import {
    getUrl,
    parentContainer,
    showAlert,
    getToken,
    callModal,
    sendRequest,
    handleFormData,
} from "./main.js";
import { redirectTo } from "./redirect.js";

parentContainer().on('click', '#search_student', function(e){
    e.preventDefault();

    callModal("create", "assessment/show-search", null);
})

parentContainer().on("click", "#student_search_btn", function (e) {
    e.preventDefault();

    $("#student_search_form").trigger("submit");
});

parentContainer().on("submit", "#student_search_form", function (e) {
    e.preventDefault();

    let _token = $('input[name="_token"]').val();
    let search = $('input[name="search"]').val();

    $.ajax({
        url: getUrl("assessment/search"),
        type: "POST",
        data: {
            _token: _token,
            search: search,
        },
        beforeSend: function () {
            $("#student_search_spinner").removeClass("d-none");
            $("#students_result_container").removeClass("d-none");
        },
        success: function (response) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
            });

            if(response.status == 200){
                $("#students_result_wrapper").html(response.view);
                $("#student_search_spinner").addClass("d-none");
            } else {

                Toast.fire({
                    icon: "success",
                    title: "Signed in successfully",
                });
                
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
});

parentContainer().on("click", ".assess-btn", function(e){
    e.preventDefault();

    let element = $(this);

    var data = {
        _token: getToken(),
        id: $(this).data('id')
    }

    element.attr("data-kt-indicator", "on");

    element.attr("disabled", true);

    sendRequest("assessment/assess", data);
});


parentContainer().on("click", '#save_assessment', function (e) {
    e.preventDefault();

    let element = $(this);

    var data = {
        _token: getToken(),
        id: $(this).data("id"),
    };

    sendRequest("assessment/store", data);

    // sendRequest("assessment/assess", data);

    element.attr("data-kt-indicator", "on");
    
    element.attr('disabled', true);
    
    if (element.hasClass("btn-success")) {
        setTimeout(function () {
            element.removeAttr("data-kt-indicator");
            element.removeClass("btn-success");
            element.addClass("btn-light");
            $(".svg-icon").addClass("d-none");
            $(".indicator-label").text("Follow");
            element.attr("disabled", false);
        }, 1500);
    } else {
        setTimeout(function () {
            console.log(element)
            element.removeAttr("data-kt-indicator");
            element.removeClass("btn-light").addClass("btn-success");
            $(".svg-icon").removeClass("d-none");
            $(".indicator-label").text("Assessed");
            element.attr("disabled", false);
        }, 1000);
    }
});

parentContainer().on('click', '#start_btn', function(e){
    e.preventDefault();

    var data = {
        _token: getToken(),
        program_id: $("#program_id_select").val(),
        year_id: $("#year_id_select").val(),
    };
    
    $(this).attr("data-kt-indicator", "on");

    $.ajax({
        url: getUrl('assessment/run-assessmenmt'),
        type: "POST",
        data: data,
        dataType: "JSON",
        success: function (response) {
            if (response.status == 200) {
                $("#start_btn").removeAttr("data-kt-indicator");
            }     
        },
        error: function (err) {
            console.log(err);
        },
    });
});
