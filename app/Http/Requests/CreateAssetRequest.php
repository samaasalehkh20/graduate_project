<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use function Symfony\Component\Translation\t;

class CreateAssetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'subdivision_id' => 'required',
            'group_id' => 'required',
            'subgroup_id' => 'required',
            'asset_type_id' => 'required',
            'asset_name_id' => 'required',
            'asset_number' => 'required|numeric',
            'code_gis' => 'required',
            'asset_location_id' => 'required',
            'first_location_id' => 'nullable',
            'second_location_id' => 'nullable',
            'funding_source' => 'required',
            'property_type' => 'required',
            'asset_age' => 'required|numeric',
            'quantity' => 'required|numeric',
            'measurement_unit_id' => 'required',
            'year_of_possession' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => __('lang.category_id_required'),
            'subdivision_id.required' => __('lang.subdivision_id_required'),
            'group_id.required' => __('lang.group_id_required'),
            'subgroup_id.required' => __('lang.subgroup_id_required'),
            'asset_type_id.required' => __('lang.asset_type_id_required'),
            'asset_name_id.required' => __('lang.asset_name_id_required'),
            'asset_number.required' => __('lang.asset_number_required'),
            'asset_number.numeric' => __('lang.asset_number_numeric'),
            'code_gis.required' => __('lang.code_gis_required'),
            'asset_location_id.required' => __('lang.asset_location_id_required'),
            'funding_source.required' => __('lang.funding_source_required'),
            'property_type.required' => __('lang.property_type_required'),
            'asset_age.required' => __('lang.asset_age_required'),
            'asset_age.numeric' => __('lang.asset_age_numeric'),
            'quantity.required' => __('lang.quantity_required'),
            'quantity.numeric' => __('lang.quantity_numeric'),
            'measurement_unit_id.required' => __('lang.measurement_unit_id_required'),
            'year_of_possession.required' => __('lang.year_of_possession_required'),
        ];
    }
}
