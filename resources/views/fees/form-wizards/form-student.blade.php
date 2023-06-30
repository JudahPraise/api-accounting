<form id="{{ isset($fee) ? 'edit_fee_form' : 'new_fee_form' }}" data-id="{{ isset($fee) ? $fee->id_key : '' }}" class="form fv-plugins-bootstrap5 fv-plugins-framework">
    @csrf
    <input type="hidden" name="type" value="1">
    <div id="student_wizard_page">
        <div class="mb-13 text-center">
            <h1 class="mb-3">Add New Student Fee</h1>
            <div class="text-muted fw-semibold fs-5">
                Enter fee details.
            </div>
        </div>
        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">Fee Name</span>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                    aria-label="Specify a target name for future usage and reference"
                    data-bs-original-title="Specify a target name for future usage and reference" data-kt-initialized="1"></i>
            </label>
            <input type="text" class="form-control form-control-solid" placeholder="Enter fee name" name="name" value="{{ isset($fee) ? $fee->name : '' }}">
            <div class="fv-plugins-message-container invalid-feedback">
                <div class="error-text name-error"></div>
            </div>
        </div>

        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">Description</span>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                    aria-label="Specify a target name for future usage and reference"
                    data-bs-original-title="Specify a target name for future usage and reference" data-kt-initialized="1"></i>
            </label>
            <input type="text" class="form-control form-control-solid" placeholder="Enter fee description" name="description" value="{{ isset($fee) ? $fee->description : '' }}">
            <div class="fv-plugins-message-container invalid-feedback">
                <div class="error-text description-error"></div>
            </div>
        </div>

        <div class="row g-9 mb-8">
            <div class="col-md-6 fv-row">
                <label class="required fs-6 fw-semibold mb-2">Fee type</label>
                <select class="form-select form-select-solid" aria-label="Select example" name="fee_type_id" id="fee_type_id">
                    <option>Select fee type</option>
                    @foreach ($fee_types as $type)
                        @if(isset($fee))
                            <option value="{{ $type->fee_type_id }}" {{ $fee->fee_type_id == $type->fee_type_id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @else
                            <option value="{{ $type->fee_type_id }}">{{ $type->name }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="fv-plugins-message-container invalid-feedback">
                    <div class="error-text fee_type_id-error"></div>
                </div>
            </div>
            <div class="col-md-6 fv-row">
                <label class="required fs-6 fw-semibold mb-2">Status</label>
                <select class="form-select form-select-solid" aria-label="Select example" name="cabs">
                    <option>Select status</option>
                    @if(isset($fee))
                        <option value="2" {{ $fee->cabs == 2 ? 'selected' : '' }}>Not Applicable</option>
                        <option value="1" {{ $fee->cabs == 1 ? 'selected' : '' }}>Cabuyeño</option>
                        <option value="0" {{ $fee->cabs == 0 ? 'selected' : '' }}>Non-Cabuyeño</option>
                    @else
                        <option value="2">Not Applicable</option>
                        <option value="1">Cabuyeño</option>
                        <option value="0">Non-Cabuyeño</option>
                    @endif
                </select>
                <div class="fv-plugins-message-container invalid-feedback">
                    <div class="error-text cabs-error"></div>
                </div>
            </div>
        </div>

        <div class="row g-9 mb-8" id="is_nstp_container">
            @if(isset($fee))
                @if ($fee->is_nstp == 1)
                    <label class="required fw-semibold fs-6 mb-5">Is NSTP Fee</label>
                    <div class="d-flex flex-column fv-row">
                        <div class="form-check form-check-custom form-check-solid mb-5">
                            <input class="form-check-input me-3" name="is_nstp" type="radio" value="1" {{ $fee->is_nstp ? 'checked' : '' }}
                            id="kt_docs_formvalidation_radio_option_1" />
                            <label class="form-check-label" for="kt_docs_formvalidation_radio_option_1">
                                <div class="fw-semibold text-gray-800">Yes</div>
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mb-5">
                            <input class="form-check-input me-3" name="is_nstp" type="radio" value="0" {{ $fee->is_nstp ? 'checked' : '' }}
                            id="kt_docs_formvalidation_radio_option_2" />
                            <label class="form-check-label" for="kt_docs_formvalidation_radio_option_2">
                                <div class="fw-semibold text-gray-800">No</div>
                            </label>
                        </div>
                    </div>
                @endif
            @endif
        </div>

        <div class="row g-9 mb-8">
            <div class="col-md-6 fv-row fv-plugins-icon-container">
                <label class="required fs-6 fw-semibold mb-2">Cost</label>
                <input type="number" class="form-control form-control-solid" placeholder="Enter cost" name="cost" value="{{ isset($fee) ? $fee->cost : '' }}" />
                <div class="fv-plugins-message-container invalid-feedback">
                    <div class="error-text cost-error"></div>
                </div>
            </div>
            <div class="col-md-6 fv-row">
                <label class="required fs-6 fw-semibold mb-2">Coverage</label>
                <select class="form-select form-select-solid" aria-label="Select example" name="coverage">
                    <option>Select fee coverage</option>
                    @if(isset($fee))
                        <option value="1" {{ $fee->coverage == 1 ? 'selected' : '' }}>Per Unit</option>
                        <option value="2" {{ $fee->coverage == 2 ? 'selected' : '' }}>Per Student</option>
                        <option value="3" {{ $fee->coverage == 3 ? 'selected' : '' }}>Per Subject</option>
                        <option value="4" {{ $fee->coverage == 4 ? 'selected' : '' }}>Per Hour</option>
                        <option value="5" {{ $fee->coverage == 5 ? 'selected' : '' }}>Per Lab Units</option>
                    @else
                        <option value="1">Per Unit</option>
                        <option value="2">Per Student</option>
                        <option value="3">Per Subject</option>
                        <option value="4">Per Hour</option>
                        <option value="5">Per Lab Units</option>
                    @endif
                </select>
                <div class="fv-plugins-message-container invalid-feedback">
                    <div class="error-text coverage-error"></div>
                </div>
            </div>
        </div>

        <div class="row g-9 mb-8">
            <div class="col-md-6 fv-row">
                <label class="required fs-6 fw-semibold mb-2">Frequency per A.Y.</label>
                <select class="form-select form-select-solid" aria-label="Select example" name="frequency">
                    <option>Select frequency per A.Y.</option>
                    @if (isset($fee))
                        <option value="1" {{ $fee->frequency == 1 ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $fee->frequency == 2 ? 'selected' : '' }}>2</option>
                    @else
                        <option value="1">1</option>
                        <option value="2">2</option>
                    @endif
                </select>
                <div class="fv-plugins-message-container invalid-feedback">
                    <div class="error-text frequency-error"></div>
                </div>
            </div>
            <div class="col-md-6 fv-row">
                <label class="required fs-6 fw-semibold mb-2">Year Level</label>
                <select class="form-select form-select-solid" aria-label="Select example" name="year_level">
                    <option>Select year level</option>
                    @if (isset($fee))
                        <option value="1" {{ $fee->year_level == 1 ? 'selected' : '' }}>All year levels</option>
                        <option value="2" {{ $fee->year_level == 2 ? 'selected' : '' }}>New Student</option>
                    @else
                        <option value="1">All year levels</option>
                        <option value="2">New Student</option>
                    @endif
                </select>
                <div class="fv-plugins-message-container invalid-feedback">
                    <div class="error-text year_level-error"></div>
                </div>
            </div>
        </div>
        <div class="mb-10">
            <label class="required fw-semibold fs-6 mb-5">Is Unifast</label>
            <div class="d-flex flex-column fv-row">
                @if (isset($fee))
                    <div class="form-check form-check-custom form-check-solid mb-5">
                        <input class="form-check-input me-3" name="is_unifast" type="radio" value="1"
                            id="kt_docs_formvalidation_radio_option_1" {{ $fee->is_unifast == 1 ? 'checked' : ''  }}/>
                        <label class="form-check-label" for="kt_docs_formvalidation_radio_option_1">
                            <div class="fw-semibold text-gray-800">Yes</div>
                        </label>
                    </div>
                    <div class="form-check form-check-custom form-check-solid mb-5">
                        <input class="form-check-input me-3" name="is_unifast" type="radio" value="0"
                            id="kt_docs_formvalidation_radio_option_2" {{ $fee->is_unifast== 0 ? 'checked' : '' }} />
                        <label class="form-check-label" for="kt_docs_formvalidation_radio_option_2">
                            <div class="fw-semibold text-gray-800">No</div>
                        </label>
                    </div>
                @else   
                    <div class="form-check form-check-custom form-check-solid mb-5">
                        <input class="form-check-input me-3" name="is_unifast" type="radio" value="1"
                            id="kt_docs_formvalidation_radio_option_1" />
                        <label class="form-check-label" for="kt_docs_formvalidation_radio_option_1">
                            <div class="fw-semibold text-gray-800">Yes</div>
                        </label>
                    </div>
                    <div class="form-check form-check-custom form-check-solid mb-5">
                        <input class="form-check-input me-3" name="is_unifast" type="radio" value="0"
                            id="kt_docs_formvalidation_radio_option_2" />
                        <label class="form-check-label" for="kt_docs_formvalidation_radio_option_2">
                            <div class="fw-semibold text-gray-800">No</div>
                        </label>
                    </div>
                @endif
            </div>
        </div>
        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
           <div class="col-md-12 fv-row">
                <label class="required fs-6 fw-semibold mb-2">Account Type</label>
                <select class="form-select form-select-solid" aria-label="Select example" name="account_type">
                    <option>Select student type</option>
                    @if (isset($fee))
                        <option value="1" {{ $fee->account_type == 1 ? 'selected' : '' }}>College</option>
                        <option value="2" {{ $fee->account_type == 2 ? 'selected' : '' }}>Senior High School</option>
                    @else
                        <option value="1">College</option>
                        <option value="2">Senior High School</option>
                    @endif
                </select>
                <div class="fv-plugins-message-container invalid-feedback">
                    <div class="error-text year_level-error"></div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
            <label class="required fs-6 fw-semibold mb-2">Reference/BOT resolution number</label>
            <input type="text" class="form-control form-control-solid" placeholder="Enter reference number"
                name="reference_number" value="{{ isset($fee) ? $fee->reference_number : '' }}" />
            <div class="fv-plugins-message-container invalid-feedback">
                <div class="error-text reference_number-error"></div>
            </div>
        </div>

        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
            <label class="required fs-6 fw-semibold mb-2">Date of approval of the BOT Resolution</label>
            <input type="date" class="form-control form-control-solid" placeholder="Pick a date" name="date_of_approval" id="kt_datepicker_1" value="{{ isset($fee) ? $fee->date_of_approval : '' }}" />
            <div class="fv-plugins-message-container invalid-feedback">
                <div class="error-text date_of_approval-error"></div>
            </div>
        </div>

        <button class="btn btn-primary w-100 modal_save_btn" id="wizard_btn_confirm">Save</button>
    </div>
</form>