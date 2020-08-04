<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function add()
    {
        $categories = Category::all();
        return view('dashboard.categories.add', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'parent_id' => 'required',
            'name' => 'required',
            'slug' => 'required'
        ]);

        if ($request->parent_id == 'null') {
            $parentID = 0;
        } else {
            $parentID = $request->parent_id;
        }

        //Save to db
        $category = Category::create([
            'parent_id' =>  $parentID,
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),

        ]);

        return Redirect::route('dashboard.categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('dashboard.categories.edit', compact(['category', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {


        if ($request->parent_id == 'null') {
            $parentID = 0;
        } else {
            $parentID = $request->parent_id;
        }

        $updatingCategory = Category::where('id', $request->id)->first();
        if ($updatingCategory) {
            $updatingCategory->update([
                'parent_id' =>  $parentID,
                'name' => $request->name,
                'slug' => $request->slug,
            ]);
        }

        return Redirect::route('dashboard.categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $deleteCategory = DB::table('categories')->where('id', $category->id)->delete();

        return Redirect::route('dashboard.categories');
    }
}
