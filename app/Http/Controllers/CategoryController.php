<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view("admin/category/List", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin/category/add");
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            "name"=> "required|min:5|max:55",
            "order"=> "required|numeric|nullable",
        ]);
        //$category = Category::create($request->all());
        $category = new Category();
        $category->name = $request->name;
        $category->order = $request->order;
        $category->is_active= $request->is_active;

        $category->save();

        return redirect()->route("admin-category")->with("success","");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getBooksByCategory($id){
        $category = Category::with('books')->findOrFail( $id );
      //  $books = $category->books;
        // dd($category->books);
        return view("category", compact("category"));
    }
}
