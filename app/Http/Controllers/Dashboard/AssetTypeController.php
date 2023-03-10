<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AssetType;
use App\Models\Group;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AssetTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $asset_types = AssetType::all();

        if( $request->ajax() ) {
            return view('dashboard.asset_type.table', compact('asset_types'))->render();
        }

        return view('dashboard.asset_type.index', compact('asset_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $groups = Group::query()->where('status', 1)->get();

        return view('dashboard.asset_type.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name_ar' => ['required'],
                'name_en' => ['required'],
                'group_id' => ['required', 'exists:groups,id']
            ],
            [
                'name_ar.required' => __('lang.name_ar_required'),
                'name_en.required' => __('lang.name_en_required'),
                'group_id.required' => __('lang.group_id_required'),
                'group_id.exists' => __('lang.group_id_exists'),
            ]
        );

        AssetType::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'group_id' => $request->group_id,
            'status' => $request->status ?? '0',
        ]);

        toastr()->success(__('lang.asset_type_created'));

        return redirect()->route('asset_type.index');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asset_type = AssetType::query()->findOrFail($id);
        $groups = Group::query()->where('status', 1)->get();

        return view('dashboard.asset_type.edit', compact('asset_type', 'groups'));
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
        $asset_type = AssetType::query()->findOrFail($id);

        $request->validate(
            [
                'name_ar' => ['required'],
                'name_en' => ['required'],
                'group_id' => ['required', 'exists:groups,id']
            ],
            [
                'name_ar.required' => __('lang.name_ar_required'),
                'name_en.required' => __('lang.name_en_required'),
                'group_id.required' => __('lang.group_id_required'),
                'group_id.exists' => __('lang.group_id_exists'),
            ]
        );

        $asset_type->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'group_id' => $request->group_id,
            'status' => $request->status ?? '0',
        ]);

        toastr()->success(__('lang.asset_type_updated'));

        return redirect()->route('asset_type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $asset_type = AssetType::query()->findOrFail($request->id)->delete();
    }
}
