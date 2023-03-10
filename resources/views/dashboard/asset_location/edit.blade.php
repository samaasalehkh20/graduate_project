<x-dashboard-layout title="{{ __('lang.asset_location') }}" subTitle="{{ __('lang.create') }}">
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
                            {{ __('lang.edit_asset_location') }}
                        </h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0 pb-5">
                    <form action="{{ route('asset_location.update', ['id' => $asset_location->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.name_ar') }}</label>
                                    <input type="text" class="form-control form-control-solid @error('name_ar') is-invalid @enderror" value="{{ $asset_location->name_ar }}" name="name_ar" placeholder="{{ __('lang.name_ar') }}"/>
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
                                    <input type="text" class="form-control form-control-solid @error('name_en') is-invalid @enderror" value="{{ $asset_location->name_en }}" name="name_en" placeholder="{{ __('lang.name_en') }}"/>
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
                                    <label for="exampleFormControlInput1" class="required form-label">{{ __('lang.order') }}</label>
                                    <select class="form-select form-select-solid @error('location_order') is-invalid @enderror" aria-label="Select example" name="location_order">
                                        <option value="1" @if( $asset_location->location_order == 1 ) selected @endif>
                                            {{ __('lang.primary_address') }}
                                        </option>
                                        <option value="2" @if( $asset_location->location_order == 2 ) selected @endif>
                                            {{ __('lang.sub_address_one') }}
                                        </option>
                                        <option value="3" @if( $asset_location->location_order == 3 ) selected @endif>
                                            {{ __('lang.sub_address_two') }}
                                        </option>
                                    </select>
                                    @error('location_order')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-10">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="status" value="1" id="flexCheckDefault" @if( $asset_location->status == 1 ) checked @endif/>
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
</x-dashboard-layout>
