
export function getToken() {
    return $('meta[name="csrf-token"]').attr("content");
}

export function getUrl(url) {
    var root = window.location.protocol + "//" + window.location.host;

    var GET_USERS_URL = root + "/" + url;

    return GET_USERS_URL;
}

export function parentContainer() {
    return $("#main_container");
}

export function initForm() {

    $('input .form-date').flatpickr();

} 

export function pageLoader(action) {
    switch (action) {
        case "open":
            $("#page_loader").removeClass("d-none");
            break;

        default:
            $("#page_loader").addClass("d-none");
            break;
    }
}

export function showAlert(status, message, redirect) {
    switch (status) {
        case "success":
            Swal.fire({
                title: "Good job!",
                text: message,
                icon: "success",
                confirmButtonColor: "#2883ED",
            }).then(function () {
                redirect;
            });
            break;
        case "error":
            Swal.fire({
                title: "Something went wrong!",
                text: message,
                icon: "error",
                confirmButtonColor: "#D0204B",
            });
            break;
        case "info":
            Swal.fire({
                title: "Oops...",
                text: message,
                icon: "info",
                confirmButtonColor: "#2883ED",
            });
            break;
        default:
            break;
    }
}

export function headerName(page, action_title){

    $("#header_name").text(
        page.charAt(0).toUpperCase() + page.substr(1).toLowerCase()
    );
    
    if(action_title != null){

        var action_button = '<a class="btn btn-primary d-flex flex-center h-35px h-lg-40px"id="header_action" >'+action_title +'</a>';

        $("#header_action_wrapper").empty().append(action_button);

    } else {

        $("#header_action").remove();

    }
}

export function breadCrumbs(state, icon){
    
    var links = [];

    links.push(state)

    var bread_item;

    $.each(links, function(index, value){
        var link = value.charAt(0).toUpperCase() + value.substr(1).toLowerCase();

        if (links.length == 1)
            bread_item =
                '<li class="breadcrumb-item text-gray-600 fw-bold lh-1"><a href="index.html" class="text-gray-700 text-hover-primary me-1"><i class="bi bi-' +
                icon  +
                '"></i></a></li><li class="breadcrumb-item"><span class="svg-icon svg-icon-4 svg-icon-gray-700 mx-n1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="../../../www.w3.org/2000/svg.html"><path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor" /></svg></span></li><li class="breadcrumb-item text-gray-500">' +
                link +
                "</li>";
        else 
            bread_item =
                '<li class="breadcrumb-item"><span class="svg-icon svg-icon-4 svg-icon-gray-700 mx-n1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="../../../www.w3.org/2000/svg.html"><path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor" /></svg></span></li><li class="breadcrumb-item text-gray-500">' +link + "</li>";
    });


    $("#main_breadcrumbs").html(bread_item);

    

}

export function callModal(action, url, data, container) {
    switch (action) {
        case "create": 
            $.ajax({
                url: getUrl(url),
                type: "GET",
                success: function (response) {
                    $("#main_modal_body").html(response.view);
                    $("#main_modal").modal("show");
                },
                error: function (err) {
                    console.log(err);
                },
            });
            break;
        case "edit":
            $.ajax({
                url: getUrl(url),
                type: "POST",
                data: data,
                success: function (response) {
                    $("#main_modal_body").html(response.view);
                    $('#' + container).html(response.form);
                    $("#main_modal").modal("show");
                },
                error: function (err) {
                    console.log(err);
                },
            });
            break;
        default:
            break;
    }
}


export function handleFormData(form, id){
    var formData = new FormData(form);

    if(id != null){
        formData.append('id', id);
    }

    const json_data = Object.fromEntries(formData.entries());

    return json_data;
}


export function sendRequest(url, data){
    $.ajax({
        url: getUrl(url),
        type: "POST",
        data: data,
        dataType: "JSON",
        beforeSend: function () {},
        success: function (response) {
            if (response.status == 200) {
                if(response.view){
                    $("#main_modal").modal("hide");
                    parentContainer().html(response.view);
                } else {
                    showAlert("success", response.message, null);
                    $("#main_modal").modal("hide");
                } 
            } else {
                showAlert("danger", response.message, null);
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}


export function loadData(url, args, page) {
    $.ajax({
        url: getUrl(url),
        type: "POST",
        data: {
            _token: getToken(),
            data: args,
        },
        beforeSend: function(){
            $("#" + page + "_table").html(
                '<div class="container p-5 d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>'
            );
        },
        success: function (view) {
            $("#" + page + "_table").html(view);
        },
    });
}

export function validateRequest(url, form, request, redirect){
    $.ajax({
        url: getUrl(url),
        type: "POST",
        data: handleFormData(form),
        dataType: "JSON",
        beforeSend: function () {
            $(document).find(".error-text").text("");
        },
        success: function (response) {
            if (response.status == 400) {
                $(".modal").animate({ scrollTop: -300 }, 800);
                $.each(response.errors, function (prefix, val) {
                    $(document)
                        .find(".error-text." + prefix + "-error")
                        .text(val);
                });
            } else {
                request;
                redirect;
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}


     

