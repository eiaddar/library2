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
            "name" => "required|min:5|max:55",
            "order" => "required|numeric|nullable",
        ]);
        //$category = Category::create($request->all());
        $filePath = "";
        dd($request->file('image_url'));
        if ($request->hasFile('image_url')) {
            $filePath = $request->file('image_url')->store('images', 'public');
        }
        dd($filePath);

        $category = new Category();
        $category->name = $request->name;
        $category->order = $request->order;
        $category->is_active = $request->is_active;
        if ($filePath) {
            $category->image_url = $filePath; // Assuming your Category model has an image_url column
        }

        $category->save();

        return redirect()->route("admin-category")->with("success", "200");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return view("admin/category/edit", compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $validation = $request->validate([
            "id" => "required",
            "name" => "required|min:5|max:55",
            "order" => "required|numeric|nullable",
        ]);

        $category = Category::find($request->id);
        // dd($category);
        $category->name = $request->name;
        $category->order = $request->order;
        $category->is_active = $request->is_active;

        $category->save();

        return redirect()->route("admin-category")->with("success", "200");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with("success", "");
        //
    }

    public function getBooksByCategory($id)
    {
        $category = Category::with('books')->findOrFail($id);
        //  $books = $category->books;
        // dd($category->books);
        return view("category", compact("category"));
    }
}
