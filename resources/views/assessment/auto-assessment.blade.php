<div class="card  card-xxl-stretch mb-5 mb-xxl-10" data-select2-id="select2-data-128-6kj2">
    <div class="card-header">
        <div class="card-title">
            <h3 class="text-gray-800">MISD Automated Assessment</h3>
        </div>
    </div>
    <div class="card-body" data-select2-id="select2-data-127-81y9">
        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-12 p-6">
            <span class="svg-icon svg-icon-2tx svg-icon-warning me-4"><svg width="24" height="24" viewBox="0 0 24 24"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor">
                    </rect>
                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor">
                    </rect>
                </svg>
            </span>
            <div class="d-flex flex-stack flex-grow-1 ">
                <div class=" fw-semibold">
                    <h4 class="text-gray-900 fw-bold">We need your attention!</h4>

                    <div class="fs-6 text-gray-700 ">Assessment only process 100 students at a time.</div>
                </div>
            </div>
        </div>
        <span class="fs-5 fw-semibold text-gray-600 pb-6 d-block">Select program and year.</span>

        <div class="d-flex align-self-center mb-5" data-select2-id="select2-data-126-tmza">
            <div class="row w-100">
                <div class="col-lg-6">
                    <div class="flex-grow-1 me-3" data-select2-id="select2-data-125-ip9g">
                        <select class="form-select" data-control="select2" data-placeholder="Select program"
                            id="program_select">
                            @foreach ($programs as $program)
                            <option value="{{ $program->program_id }}">{{ $program->program_code }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="flex-grow-1 me-3" data-select2-id="select2-data-125-ip9g">
                        <select class="form-select" data-control="select2" data-placeholder="Select year"
                            id="year_select">
                            <option value="1">1st year</option>
                            <option value="2">2nd year</option>
                            <option value="3">3rd year</option>
                            <option value="4">4th year</option>
                            <option value="5">5th year</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary btn-icon flex-shrink-0" tooltip="Generate" flow="up"
                id="automate_button">
                <span class="svg-icon svg-icon-1">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)"
                            fill="currentColor"></rect>
                        <path
                            d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z"
                            fill="currentColor">
                        </path>
                    </svg>
                </span>
            </button>
        </div>
        
        <span class="fs-5 fw-semibold text-gray-600 pb-6 d-block">Assessment Progress</span>
        <div class="h-10px w-100 bg-light mb-5" id="progressbar_wrapper"  flow="up" data-kt-initialized="1">
            <div class="bg-primary rounded h-10px" id="progressbar" role="progressbar"></div>
        </div>
    </div>
</div>


<script type="module" src="{{ asset('app/Assessment.js') }}"></script>