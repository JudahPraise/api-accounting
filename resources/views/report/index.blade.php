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
                <input type="text" data-kt-ecommerce-product-filter="search" id="search_fee"
                    class="form-control form-control-solid w-250px ps-14" placeholder="Search report">
            </div>
        </div>
    </div>

    <div class="card-body px-10" id="fees_container">
        <div class="py-5">
            <div class="row">
                <div class="col-md-4">
                    <a href="{{ route('report.get.excel') }}" class="card hover-elevate-up shadow-sm parent-hover">
                        <div class="card-body d-flex align-items-center">
                            <span class="svg-icon svg-icon-1">
                                <img src="{{ asset('assets/media/icons/xls.png') }}" alt="" srcset="" height="40">
                            </span>
                            <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                                Unifast 2nd sem 2022-2023 - Consolidated FORM 2
                            </span>
                            <button class="btn btn-icon btn-success ms-auto">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3"
                                        d="M19 15C20.7 15 22 13.7 22 12C22 10.3 20.7 9 19 9C18.9 9 18.9 9 18.8 9C18.9 8.7 19 8.3 19 8C19 6.3 17.7 5 16 5C15.4 5 14.8 5.2 14.3 5.5C13.4 4 11.8 3 10 3C7.2 3 5 5.2 5 8C5 8.3 5 8.7 5.1 9H5C3.3 9 2 10.3 2 12C2 13.7 3.3 15 5 15H19Z"
                                        fill="currentColor" />
                                    <path d="M13 17.4V12C13 11.4 12.6 11 12 11C11.4 11 11 11.4 11 12V17.4H13Z" fill="currentColor" />
                                    <path opacity="0.3" d="M8 17.4H16L12.7 20.7C12.3 21.1 11.7 21.1 11.3 20.7L8 17.4Z" fill="currentColor" />
                                </svg>
                            </button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module" src="{{ asset('app/Report.js') }}"></script>