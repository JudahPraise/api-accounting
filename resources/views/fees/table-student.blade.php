@if(!$fees->isEmpty())
    <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
        <tr class="fw-bold fs-6 text-gray-800">
            <th class="min-w-250px">Description</th>
            <th class="min-w-100px text-center">Account Type</th>
            <th class="min-w-100px text-center">Cost</th>
            <th class="min-w-150px text-center">Reference Number</th>
            <th class="min-w-150px text-center">Date of Approval</th>
            @if (Auth::user()->user_role == 1)
                <th></th>
            @endif
        </tr>
    </thead>
    <tbody class="fw-6 fw-semibold text-gray-600" id="fees_table_all">
        @foreach($fees as $fee)
        <tr>
            <td class="">{{ $fee->description_text }}</td>
            <td class="text-center">{{ $fee->account_type_text }}</td>
            <td class="text-center"><span>&#8369;</span>{{ $fee->cost }}</td>
            <td class="text-center">{{ $fee->reference_number }}</td>
            <td class="text-center">{{ $fee->date_of_approval }}</td>
            @if (Auth::user()->user_role == 1)
                <td class="text-end">
                    <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm mb-1 fee-edit-btn" data-id="{{ $fee->id_key }}"
                        data-type="{{ $fee->type }}">
                        <span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                    fill="currentColor"></path>
                                <path
                                    d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                    fill="currentColor"></path>
                            </svg>
                        </span>
                    </a>
                    <a class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm mb-1 fee-delete-btn" data-id="{{ $fee->id_key }}"
                        data-type="{{ $fee->type }}">
                        <span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                    fill="currentColor"></path>
                                <path opacity="0.5"
                                    d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                    fill="currentColor"></path>
                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                    fill="currentColor"></path>
                            </svg>
                        </span>
                    </a>
                </td>
            @endif
        </tr>
        @endforeach
    </tbody>
@else
    <div class="card-px text-center pt-15 pb-15">
        <h2 class="fs-2x fw-bold mb-0">Add New Student Fee</h2>
        <p class="text-gray-400 fs-4 fw-semibold py-7">
            Encode student fees i.e. Student Assessment, <br>Adding and Changing of Courses, Graduation Fee etc.
        </p>

    </div>
    <div class="text-center pb-15 px-5">
        <img src="{{ asset('/assets/media/illustrations/sketchy-1/16.png') }}" alt="" class="mw-100 h-200px h-sm-325px">
    </div>
@endif