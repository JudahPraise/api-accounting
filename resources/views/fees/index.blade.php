<div class="card mb-5 mb-lg-10">
    <div class="card-header align-items-center py-5 gap-2 gap-md-5" data-select2-id="select2-data-127-4mlp">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <span class="svg-icon svg-icon-1 position-absolute ms-4"><svg width="24" height="24" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                            transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                        <path
                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                            fill="currentColor"></path>
                    </svg>
                </span>
                <input type="text" data-kt-ecommerce-product-filter="search" id="search_fee" class="form-control form-control-solid w-250px ps-14">
            </div>
        </div>
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
            <div class="w-100 mw-150px">
                <select class="fees_filter_select form-select" id="fees_filter_select">
                    
                </select>
            </div>
        </div>
    </div>

    <div class="card-body p-0" id="fees_container">
        <div class="table-responsive h-100">
            <table class="table table-hover gy-4 gs-9" id="fees_table">
                <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th class="min-w-250px">Description</th>
                        <th class="min-w-100px text-center">Account Type</th>
                        <th class="min-w-100px text-center">Cost</th>
                        <th class="min-w-150px text-center">Reference Number</th>
                        <th class="min-w-150px text-center">Date of Approval</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="fw-6 fw-semibold text-gray-600" id="fees_table_all">
                </tbody>
            </table>
            <div id="fees_empty_state"></div>
        </div>
    </div>
</div>

<x-modal />

<script type="module" src="{{ asset('app/Fee.js') }}"></script>
