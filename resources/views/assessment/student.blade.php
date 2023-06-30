<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
            <div class="me-7 mb-4">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img src="{{ asset('/assets/media/avatars/300-1.jpg') }}" alt="image">
                    <div
                        class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                    </div>
                </div>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <div class="d-flex flex-column">
                        <h5 style="font-size: 14px" class="text-muted fw-bold"><span class="copy-to-clipboard text-hover-primary" id="student_number" tooltip="Student Number" flow="up">#{{ $enrolment->student->stud_id }}</span></h5>
                        <div class="d-flex align-items-center mb-2">
                            <br>
                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1 copy-to-clipboard">{{ $enrolment->student->fullname }}</a>
                            @if($enrolment->student->is_cabs == 1)
                                <a href="#" tooltip="{{ $enrolment->student->classification }}" flow="up">
                                    <span class="svg-icon svg-icon-1 svg-icon-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                            height="24px" viewBox="0 0 24 24">
                                            <path
                                                d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z"
                                                fill="currentColor"></path>
                                            <path
                                                d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z"
                                                fill="white"></path>
                                        </svg>
                                    </span>
                                </a>
                            @endif
                            <a href="#" class="btn btn-sm btn-light-success fw-bold ms-2 fs-8 py-1 px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Enroled</a>
                        </div>
                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <span class="svg-icon svg-icon-4 me-1"><svg width="18" height="18" viewBox="0 0 18 18"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3"
                                            d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z"
                                            fill="currentColor"></path>
                                        <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                {{ $enrolment->program->program_code }}
                            </a>
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2 copy-to-clipboard">
                                <span class="svg-icon svg-icon-4 me-1"><svg width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3"
                                            d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                {{ $enrolment->student->address_brgy.', '.$enrolment->student->address_citytown }}
                            </a>
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2 copy-to-clipboard">
                                <span class="svg-icon svg-icon-4 me-1"><svg width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3"
                                            d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                {{ $enrolment->student->emailaddress }}
                            </a>
                        </div>
                    </div>

                    <div class="d-flex my-4">
                        @if($enrolment->isassessed == 1)
                            <button class="btn btn-sm me-2 save-assessment btn-success" id="save_assessment"
                                data-id="eyJpdiI6ImgzLzVxQVJZcWZEMlVoOVFNbEhDaHc9PSIsInZhbHVlIjoiVm5QY3M4eGFkQ2V6aGwyVkdzS2ZEUT09IiwibWFjIjoiOWNhODc4YWQ0MzYwNzYxZjVmNWZkZjQ5Mzk2OWQ5YmY3NTJiNzliZTdiYzQ0NzMxMzE3NzM0YTUxZThjMmQ0YiIsInRhZyI6IiJ9">
                                <span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3"
                                            d="M10 18C9.7 18 9.5 17.9 9.3 17.7L2.3 10.7C1.9 10.3 1.9 9.7 2.3 9.3C2.7 8.9 3.29999 8.9 3.69999 9.3L10.7 16.3C11.1 16.7 11.1 17.3 10.7 17.7C10.5 17.9 10.3 18 10 18Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M10 18C9.7 18 9.5 17.9 9.3 17.7C8.9 17.3 8.9 16.7 9.3 16.3L20.3 5.3C20.7 4.9 21.3 4.9 21.7 5.3C22.1 5.7 22.1 6.30002 21.7 6.70002L10.7 17.7C10.5 17.9 10.3 18 10 18Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <span class="indicator-label">Assessed</span>
                                <span class="indicator-progress">
                                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            <a id="reassess" target="_blank" data-id="{{ $enrolment->student->id_key }}"
                                class="btn btn-sm btn-light btn-icon mx-2" tooltip="Reassess" flow="up">
                                <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.5 20.7259C14.6 21.2259 14.2 21.826 13.7 21.926C13.2 22.026 12.6 22.0259 12.1 22.0259C9.5 22.0259 6.9 21.0259 5 19.1259C1.4 15.5259 1.09998 9.72592 4.29998 5.82592L5.70001 7.22595C3.30001 10.3259 3.59999 14.8259 6.39999 17.7259C8.19999 19.5259 10.8 20.426 13.4 19.926C13.9 19.826 14.4 20.2259 14.5 20.7259ZM18.4 16.8259L19.8 18.2259C22.9 14.3259 22.7 8.52593 19 4.92593C16.7 2.62593 13.5 1.62594 10.3 2.12594C9.79998 2.22594 9.4 2.72595 9.5 3.22595C9.6 3.72595 10.1 4.12594 10.6 4.02594C13.1 3.62594 15.7 4.42595 17.6 6.22595C20.5 9.22595 20.7 13.7259 18.4 16.8259Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M2 3.62592H7C7.6 3.62592 8 4.02592 8 4.62592V9.62589L2 3.62592ZM16 14.4259V19.4259C16 20.0259 16.4 20.4259 17 20.4259H22L16 14.4259Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </a>
                        @else
                            <button class="btn btn-sm btn-light me-2 save-assessment" id="save_assessment"
                                data-id="{{ $enrolment->student->id_key }}">
                                <span class="svg-icon svg-icon-3 d-none"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3"
                                            d="M10 18C9.7 18 9.5 17.9 9.3 17.7L2.3 10.7C1.9 10.3 1.9 9.7 2.3 9.3C2.7 8.9 3.29999 8.9 3.69999 9.3L10.7 16.3C11.1 16.7 11.1 17.3 10.7 17.7C10.5 17.9 10.3 18 10 18Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M10 18C9.7 18 9.5 17.9 9.3 17.7C8.9 17.3 8.9 16.7 9.3 16.3L20.3 5.3C20.7 4.9 21.3 4.9 21.7 5.3C22.1 5.7 22.1 6.30002 21.7 6.70002L10.7 17.7C10.5 17.9 10.3 18 10 18Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <span class="indicator-label">Save Assessment</span>
                                <span class="indicator-progress">
                                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        @endif
                        @if(Auth::user()->user_role == 1)
                            <a href="{{ route('assessment.streamAssessment', $enrolment->student->id_key) }}" target="_blank"
                                class="btn btn-sm btn-light btn-icon " tooltip="View Assessment" flow="up">
                                <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3"
                                            d="M19 15C20.7 15 22 13.7 22 12C22 10.3 20.7 9 19 9C18.9 9 18.9 9 18.8 9C18.9 8.7 19 8.3 19 8C19 6.3 17.7 5 16 5C15.4 5 14.8 5.2 14.3 5.5C13.4 4 11.8 3 10 3C7.2 3 5 5.2 5 8C5 8.3 5 8.7 5.1 9H5C3.3 9 2 10.3 2 12C2 13.7 3.3 15 5 15H19Z"
                                            fill="currentColor" />
                                        <path d="M13 17.4V12C13 11.4 12.6 11 12 11C11.4 11 11 11.4 11 12V17.4H13Z" fill="currentColor" />
                                        <path opacity="0.3" d="M8 17.4H16L12.7 20.7C12.3 21.1 11.7 21.1 11.3 20.7L8 17.4Z" fill="currentColor" />
                                    </svg>
                                </span>
                            </a>
                        @endif
                    </div>
                </div>
                
                <div class="d-flex flex-wrap flex-stack">
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <div class="d-flex flex-wrap">
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="fs-2 fw-bold counted">
                                        {{ $enrolment->year_standing }}
                                    </div>
                                </div>
                                <div class="fw-semibold fs-6 text-gray-400">Year</div>
                            </div>

                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="75" data-kt-initialized="1">{{ $enrolment->enroled_units }}</div>
                                </div>
                                <div class="fw-semibold fs-6 text-gray-400">Units</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="60" data-kt-countup-prefix="%" data-kt-initialized="1">{{ $schedules->count() }}</div>
                                </div>
                                <div class="fw-semibold fs-6 text-gray-400">No. of Subjects</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-5 mb-lg-10">
    <div class="card-header">
        <div class="card-title w-100">
            <div class="row d-flex align-items-center w-100">
                <div class="col-4">
                    <h3>Enlisted Courses</h3>
                </div>
                <div class="col-8 d-flex align-items-center justify-content-end">
                    <span class="badge badge-light-primary badge-lg ms-2">Total Units: {{ $enrolment->enroled_units }}</span>
                    <span class="badge badge-light-success badge-lg ms-2">Lec: {{ $enrolment->lec_units }}</span>
                    <span class="badge badge-light-info badge-lg ms-2">Lab: {{ $enrolment->lab_units }}</span>
                    <span class="badge badge-light-warning badge-lg ms-2">CLab: {{ $enrolment->clab_units ? $enrolment->clab_units : 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle table-row-bordered table-row-solid gy-4 gs-9">
                <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
                    <tr>
                        <th class="min-w-100px">Code</th>
                        <th class="min-w-200px">Description</th>
                        <th class="min-w-150px text-center">Lec Units</th>
                        <th class="min-w-150px text-center">Lab Units</th>
                        <th class="min-w-150px text-center">Day</th>
                        <th class="min-w-150px">Time</th>
                        <th class="min-w-150px">Room</th>
                        <th class="min-w-150px">Section</th>
                    </tr>
                </thead>
                <tbody class="fw-6 fw-semibold text-gray-600">
                    @foreach($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->code }}</td>
                            <td>{{ $schedule->description }}</td>
                            <td class="text-center">{{ $schedule->lec_units }}</td>
                            <td class="text-center">{{ $schedule->lab_units ? $schedule->lab_units : 'N/A' }}</td>
                            <td class="text-center">{{ $schedule->day }}</td>
                            <td>{{ $schedule->time }}</td>
                            <td>{{ $schedule->room }}</td>
                            <td>{{ $schedule->block }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card mb-5 mb-lg-10">
    <div class="card-header ribbon ribbon-end ribbon-clip">
        <div class="card-title">
            <h3>Assessment Breakdown</h3>
        </div>
        <div class="ribbon-label {{ $enrolment->student->has_unifast ? 'bg-success' : 'bg-danger' }}">{{
            $enrolment->student->has_unifast ? 'Unifast' : 'Non-unifast' }}</div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle table-row-bordered table-row-solid gy-4 gs-9" style="width: 100%">
                <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
                    <tr>
                        <th class="min-w-50px">Particulars</th>
                        <th class="min-w-100px text-end">Unifast</th>
                        <th class="min-w-150px text-end">Net Payable</th>
                    </tr>
                </thead>
            </table>

            <div class="rounded p-3">
                <div class="accordion accordion-icon-toggle" id="kt_accordion_2">
                    @foreach($fee_types as $key => $fee_type)
                    <div class="">
                        <div class="accordion-header fw-6 fw-semibold text-gray-600 py-3 d-flex collapsed" data-bs-toggle="collapse"
                            data-bs-target="#kt_accordion_2_item_{{ $key }}" aria-expanded="false">
                            <span class="accordion-icon">
                                <span class="svg-icon svg-icon-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
                                            transform="rotate(-180 18 13)" fill="currentColor"></rect>
                                        <path
                                            d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                            </span>
                            <table style="width: 100%">
                                <tr style="width: 20%;">
                                    <td class="" style="width: 22%;">{{ $fee_type->name }}</td>
                                    @if ($enrolment->student->has_unifast)
                                    <td class="text-end pe-5" style="width: 20%;">{{ number_format($fees->where('fee_type_id',
                                        $fee_type->fee_type_id)->where('unifast', 1)->sum('cost'), 2) }}</td>
                                    <td class="text-end pe-5" style="width: 30%;">{{ number_format($fees->where('fee_type_id',
                                        $fee_type->fee_type_id)->where('unifast', 0)->sum('cost'), 2) }}</td>
                                    @else
                                    <td class="text-end pe-5" style="width: 20%;">{{ 0.00 }}</td>
                                    <td class="text-end pe-5" style="width: 30%;">{{ number_format($fees->where('fee_type_id',
                                        $fee_type->fee_type_id)->sum('cost'), 2) }}</td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                        <div id="kt_accordion_2_item_{{ $key }}" class="fw-6 fw-semibold text-gray-600 ps-10 collapse"
                            data-bs-parent="#kt_accordion_2" style="">
                            <span class="text-muted" style="font-size: 10px; font-weight: 200">Fees Breakdown</span>
                            <table style="width: 100%">
                                @foreach($fees->where('fee_type_id', $fee_type->fee_type_id) as $f)
                                <tr style="width: 20%;">
                                    <td class="" style="width: 20%;">{{ $f->name }}</td>
                                    @if ($enrolment->student->has_unifast)
                                    <td class="text-end pe-5" style="width: 28%;">{{ $f->unifast == 1 ? number_format($f->cost, 2) :
                                        0.00 }}</td>
                                    <td class="text-end pe-5" style="width: 35%;">{{ $f->unifast == 0 ? number_format($f->cost, 2) :
                                        0.00 }}</td>
                                    @else
                                    <td class="text-end pe-5" style="width: 28%;">{{ 0.00 }}</td>
                                    <td class="text-end pe-5" style="width: 35%;">{{ number_format($f->cost, 2) }}</td>
                                    @endif
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    @endforeach
                    <div class="">
                        <div class="accordion-header fw-6 fw-semibold text-gray-600 py-3 d-flex collapsed" data-bs-toggle="collapse"
                            data-bs-target="#kt_accordion_2_item_{{ $key }}" aria-expanded="false">
                            <div class="d-flex flex-column w-100">
                                <table style="width: 100%">
                                    <tr style="width: 23%;">
                                        <th style="width: 10%;">Total:</th>
                                        <th class="text-end" style="width: 48%;">{{ $enrolment->student->has_unifast ?
                                            number_format($fees->where('unifast',1)->sum('cost'), 2) : '0.00' }}</th>
                                        <th class="text-end" style="width: 70%;">{{ $enrolment->student->has_unifast ?
                                            number_format($fees->where('unifast',0)->sum('cost'), 2) :
                                            number_format($fees->sum('cost'), 2) }}</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module" src="{{ asset('app/Assessment.js') }}"></script>