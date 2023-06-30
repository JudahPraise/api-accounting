<div id="type_wizard_page">
    <div class="mb-13 text-center">
        <h1 class="mb-3">Select Account Type</h1>
        <div class="text-muted fw-semibold fs-5">
            Who are going to pay for this fee?
        </div>
    </div>
    <div class="pb-10">
        <input type="radio" class="btn-check" name="account_type" value="student"
            id="kt_modal_two_factor_authentication_option_1">
        <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-5"
            for="kt_modal_two_factor_authentication_option_1">
            <span class="svg-icon svg-icon-4x me-4">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.3"
                        d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z"
                        fill="currentColor" />
                    <path
                        d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z"
                        fill="currentColor" />
                    <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor" />
                </svg>
            </span>
            <span class="d-block fw-semibold text-start">
                <span class="text-dark fw-bold d-block fs-3">Student</span>
                <span class="text-muted fw-semibold fs-6">
                    Encode student fees i.e. Student Assessment, Adding and Changing of Courses, Graduation Fee etc.
                </span>
            </span>
        </label>
        <input type="radio" class="btn-check" name="account_type" value="others"
            id="kt_modal_two_factor_authentication_option_2">
        <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center"
            for="kt_modal_two_factor_authentication_option_2">
            <span class="svg-icon svg-icon-4x me-4">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                    <rect x="11" y="11" width="2" height="2" rx="1" fill="currentColor" />
                    <rect x="15" y="11" width="2" height="2" rx="1" fill="currentColor" />
                    <rect x="7" y="11" width="2" height="2" rx="1" fill="currentColor" />
                </svg>
            </span>
            <span class="d-block fw-semibold text-start">
                <span class="text-dark fw-bold d-block fs-3">Others</span>
                <span class="text-muted fw-semibold fs-6">
                    Encode other fees i.e. Faculty fee, Rental fee etc.
                </span>
            </span>
        </label>
    </div>

    <button class="btn btn-primary w-100 wizard-btn" id="wizard-btn-continue" data-page="">Continue</button>
</div>
</div>