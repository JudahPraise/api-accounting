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

export function getToast() {
    const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    return Toast;
}

export function pageNotFound(){
    return(
        `<div class="container d-flex justify-content-center align-items-center flex-column" style="width: 100%; height: 70vh;">
                <h1 style="font-size: 250px; font-weight: 900; color: rgba(151, 151, 151, 0.395)">404</h1>
                <h6 style="font-size: 30px; color: rgba(151, 151, 151, 0.395)">Page not found</h6>
            </div>`
    );
}

export function setEmptyState(image, title, subtitle){
    const html = `<div class="card-px text-center pt-15 pb-15">
                    <h2 class="fs-2x fw-bold mb-0">${title}</h2>
                    <p class="text-gray-400 fs-4 fw-semibold py-7">
                        ${subtitle}
                    </p>
            
                </div>
                <div class="text-center pb-15 px-5">
                    <img src="${image}" alt="" class="mw-100 h-200px h-sm-325px">
                </div>`;

    return html;
}

export function setHeaderAction(html) {
    $("#header_action_wrapper").empty().append(html);
}

export function formDataHandler(form) {
    const json_data = Object.fromEntries(form.entries());

    return json_data;
}

export function onLoadHandler(state, target) {
    var currentStateText = target[0].title;

    if (state == true) {
        target.html(
            `<span class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true" id="spinner"></span>`
        );
        target.attr("disabled", true);
    } else {
        target.attr("disabled", false);
        target.empty().append(currentStateText);
    }
}

export function requestHandler(type, url, data) {
    var promise, response;

    switch (type) {
        case "GET":
            promise = axios.get(url);
            response = promise.then((response) => response.data);

            return response;


        case "POST":
            promise = axios.post(url, formDataHandler(data));
            response = promise.then((response) => response.data);

            return response;
    }
}

export function pageHandler(page, id){

    var formData = new FormData();
    formData.append("_token", getToken());
    formData.append("page", page);

    if(page == 'student'){
        formData.append("id", id ? id : sessionStorage.getItem("id"));
    }

    requestHandler("POST", getUrl("set-page"), formData)
        .then((response) => {
           
            if(page){
                window.history.pushState(null, null, page);
                parentContainer().empty().append(response);
            } else {
                parentContainer().empty().append(pageNotFound());
            }
            
        })
        .catch((err) => console.log(err))
        .finally(() => {
            $('#main_modal').modal('hide');
            $("#page_loader").remove();
            $(document.body).removeClass("modal-open").css({'overflow': '', 'padding-right': ''});
            $(".modal-backdrop").remove();
        });
}


