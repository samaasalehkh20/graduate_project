<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        if( $request->ajax() ) {
            return view('dashboard.category.table', compact('categories'))->render();
        }

        return view('dashboard.category.index',  compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('dashboard.category.create');
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
                'name_en.required' => __('lang.name_en_required')
            ]
        );

        Category::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status' => $request->status ?? '0',
        ]);

        toastr()->success(__('lang.category_created'));

        return redirect()->route('category.index');
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
        $category = Category::query()->findOrFail($id);

        return view('dashboard.category.edit', compact('category'));
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
        $category = Category::query()->findOrFail($id);

        $request->validate(
            [
                'name_ar' => ['required'],
                'name_en' => ['required'],
            ],
            [
                'name_ar.required' => __('lang.name_ar_required'),
                'name_en.required' => __('lang.name_en_required')
            ]
        );

        $category->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status' => $request->status ?? '0',
        ]);

        toastr()->success(__('lang.category_updated'));

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category = Category::query()->findOrFail($request->id)->delete();
    }
}
