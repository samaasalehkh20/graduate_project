<!--begin::Table-->
<table class="table align-middle table-row-dashed gy-5" id="kt_table_customers_payment">
    <!--begin::Table head-->
    <thead class="border-bottom border-gray-200 fs-7 fw-bolder">
    <!--begin::Table row-->
    <tr class="text-start text-muted text-uppercase gs-0">
        <th class="min-w-100px">#</th>
        <th class="min-w-100px">
            {{ __('lang.name') }}
        </th>
        <th class="min-w-100px">
            {{ __('lang.subdivision') }}
        </th>
        <th class="min-w-100px">
            {{ __('lang.type') }}
        </th>
        <th class="min-w-100px">
            {{ __('lang.parent_group') }}
        </th>
        <th>
            {{ __('lang.status') }}
        </th>
        <th class="min-w-125px">
            {{ __('lang.date') }}
        </th>
        <th class="text-end min-w-70px pe-4">
            {{ __('lang.action') }}
        </th>
    </tr>
    <!--end::Table row-->
    </thead>
    <!--end::Table head-->
    <!--begin::Table body-->
    <tbody class="fs-6 fw-bold text-gray-600">
    <!--begin::Table row-->
    @foreach( $groups as $key => $group )
        <tr>
            <!--begin::Invoice=-->
            <td>
                <a href="#" class="text-gray-600 text-hover-primary mb-1">
                    {{ $key += 1 }}
                </a>
            </td>
            <!--end::Invoice=-->
            <!--begin::Status=-->
            <td>
                {{  app()->getLocale()  === 'ar' ? $group->name_ar : $group->name_en }}
            </td>
            <!--end::Status=-->
            <!--begin::Status=-->
            <td>
                {{ app()->getLocale()  === 'ar' ? $group->subdivision->name_ar : $group->subdivision->name_en  }}
            </td>
            <!--end::Status=-->

            <td>
                @if( !$group->is_subgroup )
                    <span>
                        Group
                    </span>
                @else
                    <span>
                        Sub Group
                    </span>
                @endif
            </td>

            <td>
                @if( $group->is_subgroup )
                    {{ app()->getLocale()  === 'ar' ? $group->parent->name_ar : $group->parent->name_en }}
                @else
                    {{ '-' }}
                @endif
            </td>
            <!--begin::Amount=-->
            <td>
                @if( $group->status == 1 )
                    <button class="btn btn-success">
                        {{ __('lang.active') }}
                    </button>
                @else
                    <button class="btn btn-danger">
                        {{ __('lang.inactive') }}
                    </button>
                @endif
            </td>
            <!--end::Amount=-->
            <!--begin::Date=-->
            <td>
                {{ \Carbon\Carbon::parse($group->created_at)->format('Y-m-d') }}
            </td>
            <!--end::Date=-->
            <!--begin::Action=-->
            <td class="pe-0 text-end">
                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                    {{ __('lang.action') }}
                    <!--begin::Svg Icon | path: icons/duotone/Navigation/Angle-down.svg-->
                    <span class="svg-icon svg-icon-5 m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)" />
                            </g>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </a>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="{{ route('group.edit', ['id' => $group->id]) }}" class="menu-link px-3">
                            {{ __('lang.edit') }}
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row" data-bs-toggle="modal" data-bs-target="#deleteGroup-{{ $group->id }}">
                            {{ __('lang.delete') }}
                        </a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::Menu-->
            </td>
            <!--end::Action=-->
        </tr>
        <!--end::Table row-->

        <div class="modal fade" tabindex="-1" id="deleteGroup-{{ $group->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ __('lang.delete_group_title') }}
                        </h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <p>
                            {{ __('lang.delete_group_body', ['group_name' => $group->name_en]) }}
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            {{ __('lang.close') }}
                        </button>
                        <button type="button" class="btn btn-danger deleteBtn" data-id="{{ $group->id }}">
                            {{ __('lang.delete') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    </tbody>
    <!--end::Table body-->
</table>
<!--end::Table-->
