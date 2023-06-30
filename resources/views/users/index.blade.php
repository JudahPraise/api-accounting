@if($users->isNotEmpty())
    <div class="col-xl-12 mb-5 mb-xl-12" data-select2-id="select2-data-137-wtsl">
        <div class="card card-flush h-xl-100" data-select2-id="select2-data-136-5gnq">
            <div class="card-header pt-7" data-select2-id="select2-data-135-q4wz">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Users</span>
                    {{-- <span class="text-gray-400 mt-1 fw-semibold fs-6">Avg. 57 orders per day</span> --}}
                </h3>
            </div>
            <div class="card-body pt-2">
                <div id="kt_table_widget_4_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-3 dataTable no-footer"
                            id="kt_table_widget_4_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-10px sorting_disabled" rowspan="1" colspan="1"
                                        style="width: 10px;">No.</th>
                                    <th class="text-start min-w-100px sorting_disabled" rowspan="1" colspan="1"
                                        style="width: 101.052px;">Name</th>
                                    <th class="text-start min-w-125px sorting_disabled" rowspan="1" colspan="1"
                                        style="width: 126.281px;">Role</th>
                                    <th class="text-start min-w-50px sorting_disabled" rowspan="1" colspan="1"
                                        style="width: 90.1354px;">Status</th>
                                    <th class="text-start sorting_disabled" rowspan="1" colspan="1"
                                        style="width: 25.3438px;"></th>
                                </tr>
                            </thead>
                            <tbody class="fw-bold text-gray-600" id="accounts_table">
                               
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div
                            class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                        </div>
                        <div
                            class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="card-px text-center pt-15 pb-15">
        <h2 class="fs-2x fw-bold mb-0">Search Users</h2>
        <p class="text-gray-400 fs-4 fw-semibold py-7"> Click on the below buttons to add user.</p>
        <a id="create_user" class="btn btn-primary er fs-6 px-8 py-4">Add Users </a>
    </div>

    <div class="text-center pb-15 px-5">
        <img src="{{ asset('/assets/media/illustrations/sketchy-1/search-state.png') }}" alt=""
            class="mw-100 h-200px h-sm-325px">
    </div>
@endif

<x-modal />

<script type="module" src="{{ asset('scripts/users.js') }}"></script>