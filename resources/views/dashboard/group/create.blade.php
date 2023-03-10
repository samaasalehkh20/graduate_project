<x-dashboard-layout title="{{ __('lang.group') }}" subTitle="{{ __('lang.create') }}">
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
                            {{ __('lang.add_group') }}
                        </h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0 pb-5">
                    <form action="{{ route('group.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.name_ar') }}</label>
                                    <input type="text" class="form-control form-control-solid @error('name_ar') is-invalid @enderror" name="name_ar" placeholder="{{ __('lang.name_ar') }}"/>
                                    @error('name_ar')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.name_en') }}</label>
                                    <input type="text" class="form-control form-control-solid @error('name_en') is-invalid @enderror" name="name_en" placeholder="{{ __('lang.name_en') }}"/>
                                    @error('name_en')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.subdivision') }}</label>
                                    <select class="form-select form-select-solid @error('category_id') is-invalid @enderror" aria-label="Select example" name="subdivision_id">
                                        <option>
                                            {{ __('lang.open_this_select_menu') }}
                                        </option>
                                        @foreach( $subdivisions as $subdivision )
                                            <option value="{{ $subdivision->id }}">
                                                {{  app()->getLocale()  === 'ar' ? $subdivision->name_ar : $subdivision->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.type') }}</label>
                                    <select class="form-select form-select-solid typeSelect @error('type') is-invalid @enderror" aria-label="Select example" @if( $groups->count() == 0 ) style="pointer-events: none" @endif name="type">
                                        <option>
                                            {{ __('lang.open_this_select_menu') }}
                                        </option>
                                        <option value="0" @if( $groups->count() == 0 ) selected @endif>
                                            {{ __('lang.group') }}
                                        </option>
                                        <option value="1">
                                            {{ __('lang.subgroup') }}
                                        </option>
                                    </select>
                                    @error('type')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if( $groups )
                            <div class="row d-none groupSelect">
                                <div class="col-6">
                                    <div class="mb-10">
                                        <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.group') }}</label>
                                        <select class="form-select form-select-solid @error('parent_id') is-invalid @enderror" aria-label="Select example" name="parent_id">
                                            @foreach( $groups as $group )
                                                <option value="{{ $group->id }}">
                                                    {{  app()->getLocale()  === 'ar' ? $group->name_ar : $group->name_en }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-10">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="status" value="1" id="flexCheckDefault"/>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ __('lang.status') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success">
                                    {{ __('lang.submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--end::Card body-->

            </div>
            <!--end::Card-->
        </div>

    </div>
    <!--end:::Tab content-->

    @section('js')
        <script>
            $(document).on('change', '.typeSelect', function(e) {
                e.preventDefault();

                console.log( $(this).val() )

                if( $(this).val() === '1' ) {
                    $('.groupSelect').removeClass('d-none');
                }else{
                    $('.groupSelect').val('');
                    $('.groupSelect').addClass('d-none');
                }
            })
        </script>
    @endsection
</x-dashboard-layout>
