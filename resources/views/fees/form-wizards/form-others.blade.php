<form id="{{ isset($fee) ? 'edit_fee_form' : 'new_fee_form' }}" data-id="{{ isset($fee) ? $fee->id_key : '' }}" class="form fv-plugins-bootstrap5 fv-plugins-framework">
    @csrf
    <input type="hidden" name="type" value="2">
    <div id="student_wizard_page">
        <div class="mb-13 text-center">
            <h1 class="mb-3">Add New Fee</h1>
            <div class="text-muted fw-semibold fs-5">
                Enter fee details.
            </div>
        </div>
        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">Fee Name</span>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                    aria-label="Specify a target name for future usage and reference"
                    data-bs-original-title="Specify a target name for future usage and reference"
                    data-kt-initialized="1"></i>
            </label>
            <input type="text" class="form-control form-control-solid" placeholder="Enter fee name" name="name"
                value="{{ isset($fee) ? $fee->name : '' }}">
            <div class="fv-plugins-message-container invalid-feedback">
                <div class="error-text name-error"></div>
            </div>
        </div>

        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">Description</span>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                    aria-label="Specify a target name for future usage and reference"
                    data-bs-original-title="Specify a target name for future usage and reference"
                    data-kt-initialized="1"></i>
            </label>
            <input type="text" class="form-control form-control-solid" placeholder="Enter fee description"
                name="description" value="{{ isset($fee) ? $fee->description : '' }}">
            <div class="fv-plugins-message-container invalid-feedback">
                <div class="error-text description-error"></div>
            </div>
        </div>

        <div class="row g-9 mb-8">
            <div class="col-md-6 fv-row">
                <label class="required fs-6 fw-semibold mb-2">Fee type</label>
                <select class="form-select form-select-solid" aria-label="Select example" name="fee_type_id">
                    <option>Select fee type</option>
                    @foreach ($fee_types as $type)
                    @if(isset($fee))
                    <option value="{{ $type->fee_type_id }}" {{ $fee->fee_type_id == $type->fee_type_id ? 'selected' :
                        '' }}>{{ $type->name }}</option>
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
                    <option value="0" {{ $fee->status == 0 ? 'selected' : '' }}>Not Applicable</option>
                    <option value="1" {{ $fee->status == 1 ? 'selected' : '' }}>Cabuyeño</option>
                    <option value="2" {{ $fee->status == 2 ? 'selected' : '' }}>Non-Cabuyeño</option>
                    @else
                    <option value="0">Not Applicable</option>
                    <option value="1">Cabuyeño</option>
                    <option value="2">Non-Cabuyeño</option>
                    @endif
                </select>
                <div class="fv-plugins-message-container invalid-feedback">
                    <div class="error-text cabs-error"></div>
                </div>
            </div>
        </div>

        <div class="row g-9 mb-8">
            <div class="col-md-6 fv-row fv-plugins-icon-container">
                <label class="required fs-6 fw-semibold mb-2">Cost</label>
                <input type="number" class="form-control form-control-solid" placeholder="Enter cost" name="cost"
                    value="{{ isset($fee) ? $fee->cost : '' }}" />
                <div class="fv-plugins-message-container invalid-feedback">
                    <div class="error-text cost-error"></div>
                </div>
            </div>
            <div class="col-md-6 fv-row">
               <label class="required fs-6 fw-semibold mb-2">Account Type</label>
                <select class="form-select form-select-solid" aria-label="Select example" name="account_type">
                    <option>Select student type</option>
                    @if (isset($fee))
                        <option value="1" {{ $fee->account_type == 1 ? 'selected' : '' }}>College</option>
                        <option value="2" {{ $fee->account_type == 2 ? 'selected' : '' }}>Senior High School</option>
                        <option value="3" {{ $fee->account_type == 3 ? 'selected' : '' }}>Faculty</option>
                        <option value="4" {{ $fee->account_type == 4 ? 'selected' : '' }}>Other</option>
                    @else
                        <option value="1">College</option>
                        <option value="2">Senior High School</option>
                        <option value="3">Faculty</option>
                        <option value="4">Other</option>
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
            <input type="date" class="form-control form-control-solid" placeholder="name@example.com"
                name="date_of_approval" value="{{ isset($fee) ? $fee->date_of_approval : '' }}" />
            <div class="fv-plugins-message-container invalid-feedback">
                <div class="error-text date_of_approval-error"></div>
            </div>
        </div>

        <button class="btn btn-primary w-100 modal_save_btn" id="wizard_btn_confirm">Save</button>
    </div>
</form>