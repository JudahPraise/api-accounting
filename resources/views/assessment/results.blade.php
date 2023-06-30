@forelse ($students as $student)
<a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
    <div class="row w-100">
        <div class="col-1 d-flex align-items-center">
            <div class="symbol symbol-35px symbol-circle me-5">
                <img alt="Pic" src="../../assets/media/avatars/300-6.jpg">
            </div>
        </div>
        <div class="col-8 ms-2 d-flex align-items-center">
            <div class="fw-semibold">
                <span class="fs-6 text-gray-800 me-2">{{ Str::upper($student->fullname) }}</span>
                {{-- <span class="badge badge-light">Art Director</span> --}}
            </div>
        </div>
        <div class="col-3 d-block">
            <button class="btn btn-sm btn-light assess-btn" data-id="{{ $student->id_key }}">
                <span class="indicator-label">Assess</span>
                <span class="indicator-progress">
                    Please Wait <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
           
            <a href="{{ route('assessment.streamAssessment', $student->id_key) }}" class="btn btn-sm btn-light" data-id="{{ $student->id_key }}">
                <span class="indicator-label">Assess</span>
                <span class="indicator-progress">
                    Please Wait <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </a>
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