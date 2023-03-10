<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AssetLocation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AssetLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $asset_locations = AssetLocation::all();

        if( $request->ajax() ) {
            return  view('dashboard.asset_location.table', compact('asset_locations'))->render();
        }

        return view('dashboard.asset_location.index', compact('asset_locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('dashboard.asset_location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name_ar' => ['required'],
                'name_en' => ['required'],
            ],
            [
                'name_ar.required' => __('lang.name_ar_required'),
                'name_en.required' => __('lang.name_en_required'),
            ]
        );

        AssetLocation::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'location_order' => $request->location_order,
            'status' => $request->status ?? '0',
            'parent_id' => '1',
        ]);

        toastr()->success(__('lang.asset_location_created'));

        return redirect()->route('asset_location.index');
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
        $asset_location = AssetLocation::query()->findOrFail($id);

        return view('dashboard.asset_location.edit', compact('asset_location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $asset_location = AssetLocation::query()->findOrFail($id);

        $request->validate(
            [
                'name_ar' => ['required'],
                'name_en' => ['required'],
            ],
            [
                'name_ar.required' => __('lang.name_ar_required'),
                'name_en.required' => __('lang.name_en_required'),
            ]
        );

        $asset_location->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'location_order' => $request->location_order,
            'status' => $request->status ?? '0',
            'parent_id' => '1',
        ]);

        toastr()->success(__('lang.asset_location_updated'));

        return redirect()->route('asset_location.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $asset_location = AssetLocation::query()->findOrFail($request->id)->delete();
    }
}
