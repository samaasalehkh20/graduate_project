<x-dashboard-layout title="{{ __('lang.asset') }}" subTitle="{{ __('lang.create') }}">
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
                            {{ __('lang.add_asset') }}
                        </h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0 pb-5">
                    <form action="{{ route('asset.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-4">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.category') }}</label>
                                    <select class="form-select form-select-solid @error('category_id') is-invalid @enderror categoryId" aria-label="Select example" name="category_id">
                                        <option value="">
                                            {{ __('lang.open_this_select_menu') }}
                                        </option>
                                        @foreach( $categories as $category )
                                            <option value="{{ $category->id }}">
                                                {{ app()->getLocale() === 'ar' ? $category->name_ar : $category->name_en }}
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
                            <div class="col-2">
                                <div class="mt-10">

                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.subdivision') }}</label>
                                    <select class="form-select form-select-solid @error('subdivision_id') is-invalid @enderror subdivisionId" aria-label="Select example" name="subdivision_id">

                                    </select>
                                    @error('subdivision_id')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-10">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.group') }}</label>
                                    <select class="form-select form-select-solid @error('group_id') is-invalid @enderror groupId" aria-label="Select example" name="group_id">

                                    </select>
                                    @error('group_id')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-10">

                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.subgroup') }}</label>
                                    <select class="form-select form-select-solid @error('subgroup_id') is-invalid @enderror subgroupId" aria-label="Select example" name="subgroup_id">

                                    </select>
                                    @error('subgroup_id')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-10">
                                    <a href="{{ route('group.create') }}" class="btn btn-primary btn-sm">
                                        {{ __('lang.new') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.asset_type') }}</label>
                                    <select class="form-select form-select-solid @error('asset_type_id') is-invalid @enderror assetTypeId" aria-label="Select example" name="asset_type_id">

                                    </select>
                                    @error('asset_type_id')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-10">
                                    <a href="{{ route('asset_type.create') }}" class="btn btn-primary btn-sm">
                                        {{ __('lang.new') }}
                                    </a>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.asset_name') }}</label>
                                    <select class="form-select form-select-solid @error('asset_name_id') is-invalid @enderror assetNameId" aria-label="Select example" name="asset_name_id">
                                        <option value="">
                                            {{ __('lang.open_this_select_menu') }}
                                        </option>
                                        @foreach( $asset_names as $asset_name )
                                            <option value="{{ $asset_name->id }}">
                                                {{ app()->getLocale() === 'ar' ? $asset_name->name_ar : $asset_name->name_en }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('asset_name_id')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-10">
                                    <a href="{{ route('asset_name.create') }}" class="btn btn-primary btn-sm">
                                        {{ __('lang.new') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.asset_number') }}</label>
                                    <input type="text" class="form-control form-control-solid @error('asset_number') is-invalid @enderror" placeholder="" name="asset_number"/>
                                    @error('asset_number')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-10">

                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-10">

                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.code_gis') }}</label>
                                    <input type="text" class="form-control form-control-solid @error('code_gis') is-invalid @enderror" placeholder="" name="code_gis"/>

                                    @error('code_gis')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="mt-10">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.primary_address') }}</label>
                                    <select class="form-select form-select-solid @error('primary_location_id') is-invalid @enderror primaryLocationId" aria-label="Select example" name="asset_location_id">
                                        <option value="">
                                            {{ __('lang.open_this_select_menu') }}
                                        </option>
                                        @foreach( $primary_locations as $primary_location )
                                            <option value="{{ $primary_location->id }}">
                                                {{ app()->getLocale() === 'ar' ? $primary_location->name_ar : $primary_location->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('primary_location_id')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-10">
                                    <a href="{{ route('asset_location.create') }}" class="btn btn-primary btn-sm">
                                        {{ __('lang.new') }}
                                    </a>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-10">

                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.sub_address_one') }}</label>
                                    <select class="form-select form-select-solid @error('sub_address_one_id') is-invalid @enderror subLocationOneId" aria-label="Select example" name="first_location_id">
                                        <option value="">
                                            {{ __('lang.open_this_select_menu') }}
                                        </option>
                                        @foreach( $sub_locations_one as $sub_location_one )
                                            <option value="{{ $sub_location_one->id }}">
                                                {{ app()->getLocale() === 'ar' ? $sub_location_one->name_ar : $sub_location_one->name_en }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('sub_address_one_id')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-10">
                                    <a href="{{ route('asset_location.create') }}" class="btn btn-primary btn-sm">
                                        {{ __('lang.new') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-4">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.sub_address_two') }}</label>
                                    <select class="form-select form-select-solid @error('sub_address_two_id') is-invalid @enderror subLocationTwoId" aria-label="Select example" name="second_location_id">
                                        <option value="">
                                            {{ __('lang.open_this_select_menu') }}
                                        </option>
                                        @foreach( $sub_locations_two as $sub_location_two )
                                            <option value="{{ $sub_location_two->id }}">
                                                {{ app()->getLocale() === 'ar' ? $sub_location_two->name_ar : $sub_location_two->name_en }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('sub_address_two_id')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-10">
                                    <a href="{{ route('asset_location.create') }}" class="btn btn-primary btn-sm">
                                        {{ __('lang.new') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-4">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">
                                        {{ app()->getLocale() === 'ar' ? $funding_source->where('sub_cd', 0)->first()->name_ar : $funding_source->where('sub_cd', 0)->first()->name_en }}
                                    </label>
                                    <select class="form-select form-select-solid @error('funding_source') is-invalid @enderror subLocationTwoId" aria-label="Select example" name="funding_source">
                                        <option value="">
                                            {{ __('lang.open_this_select_menu') }}
                                        </option>
                                        @foreach( $funding_source->where('sub_cd', '!=', 0) as $source )
                                            <option value="{{ $source->name_en }}">
                                                {{ app()->getLocale() === 'ar' ? $source->name_ar : $source->name_en }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('funding_source')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-10">

                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">
                                        {{ app()->getLocale() === 'ar' ? $property_type->where('sub_cd', 0)->first()->name_ar : $property_type->where('sub_cd', 0)->first()->name_en }}
                                    </label>
                                    <select class="form-select form-select-solid @error('property_type') is-invalid @enderror subLocationTwoId" aria-label="Select example" name="property_type">
                                        <option value="">
                                            {{ __('lang.open_this_select_menu') }}
                                        </option>
                                        @foreach( $property_type->where('sub_cd', '!=', 0) as $type )
                                            <option value="{{ $type->name_en }}">
                                                {{ app()->getLocale() === 'ar' ? $type->name_ar : $type->name_en }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('property_type')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-10">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.quantity') }}</label>
                                    <input type="text" class="form-control form-control-solid @error('quantity') is-invalid @enderror" placeholder="" name="quantity"/>
                                    @error('quantity')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-10">

                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">
                                        {{ __('lang.measurement_unit') }}
                                    </label>
                                    <select class="form-select form-select-solid @error('measurement_unit') is-invalid @enderror subLocationTwoId" aria-label="Select example" name="measurement_unit_id">
                                        <option value="">
                                            {{ __('lang.open_this_select_menu') }}
                                        </option>
                                        @foreach( $measurement_units as $measurement_unit )
                                            <option value="{{ $measurement_unit->id }}">
                                                {{ app()->getLocale() === 'ar' ? $measurement_unit->name_ar : $measurement_unit->name_en }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('measurement_unit_id')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-10">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.year_of_possession') }}</label>
                                    <input type="date" class="form-control form-control-solid @error('year_of_possession') is-invalid @enderror" placeholder="" name="year_of_possession"/>
                                    @error('year_of_possession')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-10">

                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.asset_age') }}</label>
                                    <input type="text" class="form-control form-control-solid @error('asset_age') is-invalid @enderror" placeholder="" name="asset_age"/>
                                    @error('asset_age')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-10">

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
            let lang = "{{ app()->getLocale() }}";
        </script>
        <script>
            // Get Subdivision Functionality
            $(document).on('change', '.categoryId', function(e) {
                e.preventDefault();

                var id = $(this).val();

                $.ajax({
                    url: "{{ route('asset.getSubdivision') }}",
                    type: "GET",
                    data: {
                        id: id,
                    },
                    success: function(data) {

                        $('.subdivisionId').empty();
                        $('.groupId').empty();
                        $('.subdivisionId').empty();


                        $('.subdivisionId').append(`
                            <option value="">
                               {{ __('lang.open_this_select_menu') }}
                            </option>
                        `);
                        $.each(data.subdivisions, function(key, value) {
                            $('.subdivisionId').append(`
                                <option value="`+ value.id +`">`+ value.name_en+`</option>
                            `);
                        })
                    },
                    error: function(data) {

                    }
                })
            });

            // Get Group Functionality
            $(document).on('change', '.subdivisionId', function(e) {
                e.preventDefault();

                var id = $(this).val();

                $.ajax({
                    url: "{{ route('asset.getGroup') }}",
                    type: "GET",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        $('.groupId').empty();
                        $('.groupId').append(`
                            <option value="">
                               {{ __('lang.open_this_select_menu') }}
                            </option>
                        `);
                        $.each(data.groups, function(key, value) {
                            $('.groupId').append(`
                                <option value="`+ value.id +`">`+ value.name_en +`</option>
                            `);
                        })
                    },
                    error: function(data) {

                    }
                })
            });

            // Get Sub Group Functionality
            $(document).on('change', '.groupId', function(e) {
                e.preventDefault();

                var id = $(this).val();

                $.ajax({
                    url: "{{ route('asset.getSubGroup') }}",
                    type: "GET",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        $('.subgroupId').empty();
                        $('.subgroupId').append(`
                            <option value="">
                               {{ __('lang.open_this_select_menu') }}
                            </option>
                        `);
                        $.each(data.subgroups, function(key, value) {
                            $('.subgroupId').append(`
                                <option value="`+ value.id +`">`+ value.name_en +`</option>
                            `);
                        })
                    },
                    error: function(data) {

                    }
                })
            });

            // Get Asset Type Functionality
            $(document).on('change', '.subgroupId', function(e) {
                e.preventDefault();

                var id = $(this).val();

                $.ajax({
                    url: "{{ route('asset.getAssetType') }}",
                    type: "GET",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        $('.assetTypeId').empty();
                        $('.assetTypeId').append(`
                            <option value="">
                               {{ __('lang.open_this_select_menu') }}
                            </option>
                        `);
                        $.each(data.assetTypes, function(key, value) {
                            $('.assetTypeId').append(`
                                <option value="`+ value.id +`">`+ value.name_en +`</option>
                            `);
                        })
                    },
                    error: function(data) {

                    }
                })
            });
        </script>
    @endsection
</x-dashboard-layout>
