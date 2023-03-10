<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AssetName;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AssetNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $asset_names = AssetName::all();

        if( $request->ajax() ) {
            return view('dashboard.asset_name.table', compact('asset_names'))->render();
        }

        return view('dashboard.asset_name.index', compact('asset_names'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('dashboard.asset_name.create');
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

        AssetName::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status'  => $request->status ?? '0',
        ]);

        toastr()->success(__('lang.asset_name_created'));

        return redirect()->route('asset_name.index');
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
        $asset_name = AssetName::query()->findOrFail($id);

        return view('dashboard.asset_name.edit', compact('asset_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $asset_name = AssetName::query()->findOrFail($id);

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

        $asset_name->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status'  => $request->status ?? '0',
        ]);

        toastr()->success(__('lang.asset_name_updated'));

        return redirect()->route('asset_name.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $asset_name = AssetName::query()->findOrFail($request->id)->delete();
    }
}
