<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Subdivision;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $groups = Group::all();

        if ($request->ajax()) {
            return view('dashboard.group.table', compact('groups'))->render();
        }

        return view('dashboard.group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $groups = Group::query()->where('is_subgroup', 0)->where('status', 1)->get();
        $subdivisions = Subdivision::query()->where('status', 1)->get();

        return view('dashboard.group.create', compact('groups', 'subdivisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name_ar' => ['required'],
                'name_en' => ['required'],
                'subdivision_id' => ['required', 'exists:subdivisions,id'],
                'type' => ['required', 'in:0,1'],
                'parent_id' => ['required_if:type,==,1', 'exists:groups,id']
            ],
            [
                'name_ar.required' => __('lang.name_ar_required'),
                'name_en.required' => __('lang.name_en_required'),
                'subdivision_id.required' => __('lang.subdivision_id_required'),
                'subdivision_id.exists' => __('lang.subdivision_id_exists'),
                'type.required' => __('lang.type_required')
            ]
        );

        Group::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'subdivision_id' => $request->subdivision_id,
            'is_subgroup' => $request->type,
            'parent_id' => $request->parent_id,
            'status' => $request->status ?? '0',
        ]);

        toastr()->success(__('lang.group_created'));

        return redirect()->route('group.index');
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
        $group = Group::query()->findOrFail($id);
        $subdivisions = Subdivision::query()->where('status', 1)->get();
        $all_groups = Group::query()->where('is_subgroup', 0)->where('status', 1)->get();

        return view('dashboard.group.edit', compact('group', 'subdivisions', 'all_groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = Group::query()->findOrFail($id);

        $request->validate(
            [
                'name_ar' => ['required'],
                'name_en' => ['required'],
                'subdivision_id' => ['required', 'exists:subdivisions,id'],
                'type' => ['required', 'in:0,1'],
                'parent_id' => ['required_if:type,==,1']
            ],
            [
                'name_ar.required' => __('lang.name_ar_required'),
                'name_en.required' => __('lang.name_en_required'),
                'subdivision_id.required' => __('lang.subdivision_id_required'),
                'subdivision_id.exists' => __('lang.subdivision_id_exists'),
                'type.required' => __('lang.type_required')
            ]
        );

        $group->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'subdivision_id' => $request->subdivision_id,
            'is_subgroup' => $request->type,
            'parent_id' => $request->parent_id,
            'status' => $request->status ?? '0',
        ]);

        toastr()->success(__('lang.group_updated'));

        return redirect()->route('group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return void
     */
    public function destroy(Request $request)
    {
        $group = Group::query()->findOrFail($request->id)->delete();
    }
}
