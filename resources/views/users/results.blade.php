@forelse ($employees as $employee)
    <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
        <div class="row w-100">
            <div class="col-1 d-flex align-items-center">
                <div class="symbol symbol-35px symbol-circle me-5">
                    <img alt="Pic" src="../../assets/media/avatars/300-6.jpg">
                </div>
            </div>
            <div class="col-9 ms-2 d-flex align-items-center">
                <div class="fw-semibold">
                    <span class="fs-6 text-gray-800 me-2">{{ Str::upper($employee->fname.' '.$employee->lname) }}</span>
                    {{-- <span class="badge badge-light">Art Director</span> --}}
                </div>
            </div>
            <div class="col-1 d-block">
                <button class="btn btn-icon btn-color-muted btn-bg-light btn-active-color-primary btn-sm me-3 user_add_btn" id="user_add_btn" data-status="add" data-id="{{ $employee->id_key }}">
                    <i class="bi bi-plus-lg"></i>
                </button>
            </div>
        </div>
    </a>    
@empty
    <div data-kt-search-element="empty" class="text-center" id="users_result_empty">
        <div class="fw-semibold py-10">
            <div class="text-gray-600 fs-3 mb-2">No user found</div>    

            <div class="text-muted fs-6">Try to search by username, full name or email...</div>
        </div>
        <div class="text-center px-5">
            <img src="../../assets/media/illustrations/sketchy-1/1.png" alt="" height="180">
        </div>
    </div>
@endforelse