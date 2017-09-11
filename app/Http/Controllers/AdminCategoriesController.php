<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all categories.
        $categories = Category::all();

        /// Load view from "resources\views\admin\categories\index.blade.php"
        return view('admin.categories.index', compact('categories'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        //
        Category::create($request->all());

        Session::flash('toastMessage', 'Category "' . $request['name'] . '" has been created.');

        return redirect()->route('admin.categories.index');
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
        //
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
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
        // Find category with specific ID and update.
        Category::findOrFail($id)->update($request->all());

        Session::flash('toastMessage', 'Category "' . $request['name'] . '" has been updated.');

        // Redirect to the list of categories in the administrator panel.
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find category with specific ID and delete.
        $category = Category::findOrFail($id);
        // Save name of the category for the toast message.
        $name = $category->name;
        // Delete this category.
        $category->delete();

        Session::flash('toastMessage', 'Category "' . $name . '" has been deleted.');

        // Redirect to the list of categories in the administrator panel.
        return redirect()->route('admin.categories.index');
    }
}
