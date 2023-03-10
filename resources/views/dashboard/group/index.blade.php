<x-dashboard-layout title="{{ __('lang.group') }}" subTitle="{{ __('lang.index') }}">
    <!--begin:::Tab content-->
    <div class="tab-content" id="myTabContent">
        <!--begin:::Tab pane-->
        <div class="tab-pane fade show active" id="kt_customer_view_overview_tab" role="tabpanel">
            <!--begin::Card-->
            <div class="card pt-4 mb-6 mb-xl-9">
                <!--begin::Card header-->
                <div class="card-header border-0">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>
                            {{ __('lang.group') }}
                        </h2>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Filter-->
                        <a href="{{ route('group.create') }}" class="btn btn-sm btn-flex btn-light-primary">
                            <!--begin::Svg Icon | path: icons/duotone/Interface/Plus-Square.svg-->
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.25" fill-rule="evenodd" clip-rule="evenodd" d="M6.54184 2.36899C4.34504 2.65912 2.65912 4.34504 2.36899 6.54184C2.16953 8.05208 2 9.94127 2 12C2 14.0587 2.16953 15.9479 2.36899 17.4582C2.65912 19.655 4.34504 21.3409 6.54184 21.631C8.05208 21.8305 9.94127 22 12 22C14.0587 22 15.9479 21.8305 17.4582 21.631C19.655 21.3409 21.3409 19.655 21.631 17.4582C21.8305 15.9479 22 14.0587 22 12C22 9.94127 21.8305 8.05208 21.631 6.54184C21.3409 4.34504 19.655 2.65912 17.4582 2.36899C15.9479 2.16953 14.0587 2 12 2C9.94127 2 8.05208 2.16953 6.54184 2.36899Z" fill="#12131A" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 17C12.5523 17 13 16.5523 13 16V13H16C16.5523 13 17 12.5523 17 12C17 11.4477 16.5523 11 16 11H13V8C13 7.44772 12.5523 7 12 7C11.4477 7 11 7.44772 11 8V11H8C7.44772 11 7 11.4477 7 12C7 12.5523 7.44771 13 8 13H11V16C11 16.5523 11.4477 17 12 17Z" fill="#12131A" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            {{ __('lang.add_group') }}
                        </a>
                        <!--end::Filter-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0 pb-5 tableData">
                    @include('dashboard.group.table')
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>

    </div >
    <!--end:::Tab content-->

    @section('js')
        <script>
            $(document).on('click', '.deleteBtn', function(e) {
                e.preventDefault();

                var id = $(this).data('id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('group.delete') }}",
                    type: "DELETE",
                    data: {
                        id: id,
                    },
                    success: function(data) {

                        $.ajax({
                            url: "{{ route('group.index') }}"
                        }).done(function(data) {
                            $('.tableData').html(data);
                        })
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Deleted Successfully',
                            showConfirmButton: false,
                            timer: 1000
                        })

                        $('#deleteGroup-'+id).modal('hide');
                    },
                    error: function(data) {

                    }
                })
            });
        </script>
    @endsection
</x-dashboard-layout>
