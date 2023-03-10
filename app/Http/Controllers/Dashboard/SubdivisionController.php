<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subdivision;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SubdivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|string
     */
    public function index(Request $request)
    {
        $subdivisions = Subdivision::all();

        if ( $request->ajax() ) {
            return view('dashboard.subdivision.table', compact('subdivisions'))->render();
        }

        return view('dashboard.subdivision.index', compact('subdivisions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = Category::query()->where('status', 1)->get();

        return view('dashboard.subdivision.create', compact('categories'));
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
                'category_id' => ['required', 'exists:categories,id']
            ],
            [
                'name_ar.required' => __('lang.name_ar_required'),
                'name_en.required' => __('lang.name_en_required'),
                'category_id.required' => __('lang.category_id_required'),
                'category_id.exists' => __('lang.category_id_exists'),
            ]
        );

        Subdivision::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'category_id' => $request->category_id,
            'status' => $request->status ?? '0',
        ]);

        toastr()->success(__('lang.subdivision_created'));

        return redirect()->route('subdivision.index');
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
        $subdivision = Subdivision::query()->findOrFail($id);

        $categories = Category::query()->where('status', 1)->get();

        return view('dashboard.subdivision.edit', compact('subdivision', 'categories'));
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
        $subdivision = Subdivision::query()->findOrFail($id);

        $request->validate(
            [
                'name_ar' => ['required'],
                'name_en' => ['required'],
                'category_id' => ['required', 'exists:categories,id']
            ],
            [
                'name_ar.required' => __('lang.name_ar_required'),
                'name_en.required' => __('lang.name_en_required'),
                'category_id.required' => __('lang.category_id_required'),
                'category_id.exists' => __('lang.category_id_exists'),
            ]
        );

        $subdivision->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'category_id' => $request->category_id,
            'status' => $request->status ?? '0',
        ]);

        toastr()->success(__('lang.subdivision_update'));

        return redirect()->route('subdivision.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $subdivision = Subdivision::query()->findOrFail($request->id)->delete();
    }
}
