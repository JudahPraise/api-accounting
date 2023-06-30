<div class="modal-header pb-0 border-0 justify-content-end">
    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
        <span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                    fill="currentColor"></rect>
                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                    fill="currentColor"></rect>
            </svg>
        </span>
    </div>
</div>

<div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">

    <div class="text-center mb-13">
        <h1 class="mb-3">Search Student</h1>
    
        <div class="text-muted fw-semibold fs-5">
            Who are you going to assess?
        </div>
    </div>
    
    <div class="alert alert-dismissible bg-light-primary border border-primary d-flex flex-column flex-sm-row p-5 mb-10">
        <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                <path
                    d="M11.276 13.654C11.276 13.2713 11.3367 12.9447 11.458 12.674C11.5887 12.394 11.738 12.1653 11.906 11.988C12.0833 11.8107 12.3167 11.61 12.606 11.386C12.942 11.1247 13.1893 10.896 13.348 10.7C13.5067 10.4947 13.586 10.2427 13.586 9.944C13.586 9.636 13.4833 9.356 13.278 9.104C13.082 8.84267 12.69 8.712 12.102 8.712C11.486 8.712 11.066 8.866 10.842 9.174C10.6273 9.482 10.52 9.82267 10.52 10.196L10.534 10.574H8.826C8.78867 10.3967 8.77 10.2333 8.77 10.084C8.77 9.552 8.90067 9.07133 9.162 8.642C9.42333 8.20333 9.81067 7.858 10.324 7.606C10.8467 7.354 11.4813 7.228 12.228 7.228C13.1987 7.228 13.9687 7.44733 14.538 7.886C15.1073 8.31533 15.392 8.92667 15.392 9.72C15.392 10.168 15.322 10.5507 15.182 10.868C15.042 11.1853 14.874 11.442 14.678 11.638C14.482 11.834 14.2253 12.0533 13.908 12.296C13.544 12.576 13.2733 12.8233 13.096 13.038C12.928 13.2527 12.844 13.528 12.844 13.864V14.326H11.276V13.654ZM11.192 15.222H12.928V17H11.192V15.222Z"
                    fill="currentColor" />
            </svg>
        </span>
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <h5 class="mb-1">Notice!</h5>
            <span>Search student number for more accurate result.</span>
        </div>
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
            data-bs-dismiss="alert">
            <i class="bi bi-x fs-1 text-primary"></i>
        </button>
    </div>
    
    <div id="kt_modal_students_search_handler" data-kt-search-keypress="true" data-kt-search-min-length="2"
        data-kt-search-enter="enter" data-kt-search-layout="inline" data-kt-search="true">
        <form data-kt-search-element="form" class="w-100 position-relative mb-5" autocomplete="off"
            id="student_search_form">
            @csrf
            <input type="text" class="form-control form-control-lg form-control-solid" name="search"
                placeholder="Search by username, fullname" data-kt-search-element="input">
            <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5"
                data-kt-search-element="spinner" id="student_search_spinner">
                <span class="spinner-border h-15px w-15px align-middle text-muted"></span>
            </span>
    
            <button type="submit" class="d-none" id="student_search_btn"></button>
        </form>
    
        <div class="py-5">
            <div data-kt-search-element="suggestions" class="d-none" id="students_result_container">
                <small>Search results</small>
                <div class="mh-375px scroll-y me-n7 pe-7" id="students_result_wrapper">
    
                </div>
            </div>
        </div>
    </div>
</div>