<div class="text-center mb-13">
    <h1 class="mb-3">Search Users</h1>

    <div class="text-muted fw-semibold fs-5">
        Invite Collaborators To Your Project
    </div>
</div>

<div id="kt_modal_users_search_handler" data-kt-search-keypress="true" data-kt-search-min-length="2"
    data-kt-search-enter="enter" data-kt-search-layout="inline" data-kt-search="true">
    <form data-kt-search-element="form" class="w-100 position-relative mb-5" autocomplete="off" id="user_search_form">
        @csrf
        <input type="text" class="form-control form-control-lg form-control-solid" name="search"
            placeholder="Search by username, fullname" data-kt-search-element="input">
        <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5"
            data-kt-search-element="spinner" id="user_search_spinner">
            <span class="spinner-border h-15px w-15px align-middle text-muted"></span>
        </span>
        
        <button type="submit" class="d-none" id="user_search_btn"></button>
    </form>

    <div class="py-5">

        <div data-kt-search-element="suggestions" class="d-none" id="users_added_container">
            <small>Added</small>
            <div class="mh-375px scroll-y me-n7 pe-7" id="users_added_wrapper">
        
            </div>
        </div>

        <div data-kt-search-element="suggestions" class="d-none" id="users_result_container">
            <small>Search results</small>
            <div class="mh-375px scroll-y me-n7 pe-7" id="users_result_wrapper">
                
            </div>
        </div>
    </div>
</div>