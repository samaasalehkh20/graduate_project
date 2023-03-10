<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SystemConstant;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SystemConstantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $system_constants = SystemConstant::all();

        if( $request->ajax() ) {
            return view('dashboard.system_constant.table', compact('system_constants'))->render();
        }

        return view('dashboard.system_constant.index', compact('system_constants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = SystemConstant::query()->whereNull('parent_id')->get();
        return view('dashboard.system_constant.create', compact('categories'));
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

        $system_constants = SystemConstant::all();
        $max_main_cd =  $system_constants->max('main_cd');

        $main_category = SystemConstant::query()->where('id', $request->parent_id)->first();

        $sub_category = null;
        if( $main_category ) {
            $sub_category = SystemConstant::query()->where('parent_id', $main_category->id)->latest()->value('sub_cd');
        }

        if( $request->parent_id == '0' ) {
            SystemConstant::create([
                'main_cd' => $max_main_cd + 1,
                'sub_cd' => 0,
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'status'  => $request->status ?? '0',
                'parent_id' => null,
            ]);
        }else{
            SystemConstant::create([
                'main_cd' => $main_category->main_cd,
                'sub_cd' => $sub_category + 1 ?? 1,
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'status'  => $request->status ?? '0',
                'parent_id' => $request->parent_id,
            ]);
        }

        toastr()->success(__('lang.system_constant_created'));

        return redirect()->route('system_constant.index');
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
        $system_constant = SystemConstant::query()->findOrFail($id);
        $categories = SystemConstant::query()->whereNull('parent_id')->get();

        return view('dashboard.system_constant.edit', compact('system_constant', 'categories'));

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
        $system_constant = SystemConstant::query()->findOrFail($id);

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

        $main_category = SystemConstant::query()->where('id', $request->parent_id)->first();

        $sub_category = null;
        if( $main_category && $system_constant->parent->id != $main_category->id ) {

            // There Is Change For Main Code Or Main Category ...

            $sub_category = SystemConstant::query()->where('parent_id', $main_category->id)->value('sub_cd');

            // If It Is Null , This Mean There Is No Sub Constant For Main Category ...
            if( !$sub_category ) {
                $sub_category = $main_category->sub_cd;
            };

        }

        if( $request->parent_id == '0' ) {
            $system_constant->update([
                'main_cd' => $main_category->main_cd ?? 1,
                'sub_cd' => 0,
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'status'  => $request->status ?? '0',
                'parent_id' => null,
            ]);
        }else{
            if( isset($sub_category) ) {
                $system_constant->update([
                    'main_cd' => $main_category->main_cd,
                    'sub_cd' => $sub_category + 1,
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'status'  => $request->status ?? '0',
                    'parent_id' => $request->parent_id,
                ]);
            }else{
                $system_constant->update([
                    'main_cd' => $main_category->main_cd,
                    'sub_cd' =>  $system_constant->sub_cd,
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'status'  => $request->status ?? '0',
                    'parent_id' => $request->parent_id,
                ]);
            }
        }

        toastr()->success(__('lang.system_constant_created'));

        return redirect()->route('system_constant.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $system_constant = SystemConstant::query()->findOrFail($request->id)->delete();
    }
}
