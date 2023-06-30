@foreach($users as $user)
    <tr class="odd">
        <td style="width: 10px">
            <a href="/metronic8/demo27/../demo27/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">{{ $loop->index+1 }}</a>
        </td>
        <td class="text-start">
            {{ Str::upper($user->employee->fname.' '.$user->employee->lname) }}
        </td>
        <td class="text-start">
            <span class="badge py-3 px-4 fs-7 badge-light-warning">{{ $user->get_role }}</span>
        </td>
        <td class="text-start">
            <span class="badge py-3 px-4 fs-7 badge-light-success">{{ $user->get_status }}</span>
        </td>
        <td class="text-start">
            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                data-kt-table-widget-4="expand_row">
                <span class="svg-icon svg-icon-3 m-0 toggle-off"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)"
                            fill="currentColor"></rect>
                        <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor">
                        </rect>
                    </svg></span>
                <span class="svg-icon svg-icon-3 m-0 toggle-on"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor">
                        </rect>
                    </svg>
                </span>
            </button>
        </td>
    </tr>
@endforeach