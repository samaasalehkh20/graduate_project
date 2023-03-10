<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MeasurementUnit;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MeasurementUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $measurement_units = MeasurementUnit::all();

        if( $request->ajax() ) {
            return view('dashboard.measurement_unit.table', compact('measurement_units'))->render();
        }

        return view('dashboard.measurement_unit.index', compact('measurement_units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('dashboard.measurement_unit.create');
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

        MeasurementUnit::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ]);

        toastr()->success(__('lang.measurement_unit_created'));

        return redirect()->route('measurement_unit.index');
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
        $measurement_unit = MeasurementUnit::query()->findOrFail($id);

        return view('dashboard.measurement_unit.edit', compact('measurement_unit'));
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
        $measurement_unit = MeasurementUnit::query()->findOrFail($id);

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

        $measurement_unit->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ]);

        toastr()->success(__('lang.measurement_unit_update'));

        return redirect()->route('measurement_unit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $measurement_unit = MeasurementUnit::query()->findOrFail($request->id)->delete();
    }
}
