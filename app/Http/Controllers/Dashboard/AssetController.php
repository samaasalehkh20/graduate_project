<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAssetRequest;
use App\Models\Asset;
use App\Models\AssetLocation;
use App\Models\AssetName;
use App\Models\AssetType;
use App\Models\Category;
use App\Models\Group;
use App\Models\MeasurementUnit;
use App\Models\Subdivision;
use App\Models\SystemConstant;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $assets = Asset::all();

        if( $request->ajax() ) {
            return view('dashboard.asset.table', compact('assets'))->render();
        }

        return view('dashboard.asset.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $data['categories'] = Category::query()->where('status', 1)->get();
        $data['asset_names'] = AssetName::query()->where('status', 1)->get();
        $data['primary_locations'] = AssetLocation::query()->where('location_order', '1')->get();
        $data['sub_locations_one'] = AssetLocation::query()->where('location_order', '2')->get();
        $data['sub_locations_two'] = AssetLocation::query()->where('location_order', '3')->get();
        $data['funding_source'] = SystemConstant::query()->where('main_cd', 1)->where('status', 1)->get();
        $data['property_type'] = SystemConstant::query()->where('main_cd', 2)->where('status', 1)->get();
        $data['measurement_units'] = MeasurementUnit::query()->get();

        return view('dashboard.asset.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAssetRequest $request)
    {
        Asset::create([
            'category_id' => $request->category_id,
            'subdivision_id' => $request->subdivision_id,
            'group_id' => $request->group_id,
            'subgroup_id' => $request->subgroup_id,
            'asset_type_id' => $request->asset_type_id,
            'asset_name_id' => $request->asset_name_id,
            'asset_location_id' => $request->asset_location_id,
            'first_location_id' => $request->first_location_id,
            'second_location_id' => $request->second_location_id,
            'asset_number' => $request->asset_number,
            'code_gis' => $request->code_gis,
            'measurement_unit_id' => $request->measurement_unit_id,
            'quantity' => $request->quantity,
            'funding_source' => $request->funding_source,
            'property_type' => $request->property_type,
            'year_of_possession' => $request->year_of_possession,
            'asset_age' => $request->asset_age,
            'status' => $request->status ?? 0,
        ]);

        toastr()->success(__('lang.asset_created'));

        return redirect()->route('asset.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $data['asset'] = Asset::query()->findOrFail($id);

        $data['categories'] = Category::query()->where('status', 1)->get();
        $data['asset_names'] = AssetName::query()->where('status', 1)->get();
        $data['primary_locations'] = AssetLocation::query()->where('location_order', '1')->get();
        $data['sub_locations_one'] = AssetLocation::query()->where('location_order', '2')->get();
        $data['sub_locations_two'] = AssetLocation::query()->where('location_order', '3')->get();
        $data['funding_source'] = SystemConstant::query()->where('main_cd', 1)->where('status', 1)->get();
        $data['property_type'] = SystemConstant::query()->where('main_cd', 2)->where('status', 1)->get();
        $data['measurement_units'] = MeasurementUnit::query()->get();

        return view('dashboard.asset.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CreateAssetRequest $request, $id)
    {
        $asset = Asset::query()->findOrFail($id);

        $asset->update([
            'category_id' => $request->category_id,
            'subdivision_id' => $request->subdivision_id,
            'group_id' => $request->group_id,
            'subgroup_id' => $request->subgroup_id,
            'asset_type_id' => $request->asset_type_id,
            'asset_name_id' => $request->asset_name_id,
            'asset_location_id' => $request->asset_location_id,
            'first_location_id' => $request->first_location_id,
            'second_location_id' => $request->second_location_id,
            'asset_number' => $request->asset_number,
            'code_gis' => $request->code_gis,
            'measurement_unit_id' => $request->measurement_unit_id,
            'quantity' => $request->quantity,
            'funding_source' => $request->funding_source,
            'property_type' => $request->property_type,
            'year_of_possession' => $request->year_of_possession,
            'asset_age' => $request->asset_age,
            'status' => $request->status ?? 0,
        ]);

        toastr()->success(__('lang.asset_updated'));

        return redirect()->route('asset.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $asset = Asset::query()->findOrFail($request->id)->delete();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getSubdivision(Request $request)
    {
        $subdivisions = Subdivision::query()->where('category_id', $request->id)->get();

        return response()->json([
            'subdivisions' => $subdivisions,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getGroup(Request $request)
    {
        $groups = Group::query()->where('is_subgroup', 0)->where('subdivision_id', $request->id)->get();

        return response()->json([
            'groups' => $groups,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getSubGroup(Request $request)
    {
        $subgroups = Group::query()->where('is_subgroup', 1)->where('parent_id', $request->id)->get();

        return response()->json([
            'subgroups' => $subgroups,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAssetType(Request $request)
    {
        $asset_types = AssetType::query()->where('group_id', $request->id)->where('status', 1)->get();

        return response()->json([
            'assetTypes' => $asset_types,
        ]);
    }
}
