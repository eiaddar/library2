<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view("admin/category/list", compact("categories"));
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
        $filePath = null;

        // Check if the request has a file and if it's valid
        if ($request->hasFile('image_url')) {
            if ($request->file('image_url')->isValid()) {
                $filePath = $request->file('image_url')->store('images/categories', 'public');

                // Optional: Add validation for file type and size
                $request->validate([
                    'image_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
            } else {
                return back()->with('error', 'Invalid file upload');
            }
        }

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
        return view("admin/category/show", compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view("admin/category/edit", compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            "id" => "required|exists:categories,id",
            "name" => "required|min:5|max:55",
            "order" => "required|numeric|nullable",
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remove_image' => 'sometimes|boolean'
        ]);

        try {
            $category = Category::findOrFail($request->id);

            // Handle file upload if a new file is provided
            if ($request->hasFile('image_url')) {
                // Validate the file
                if ($request->file('image_url')->isValid()) {
                    // Delete old image if it exists
                    if ($category->image_url && Storage::disk('public')->exists($category->image_url)) {
                        Storage::disk('public')->delete($category->image_url);
                    }

                    // Store new image
                    $filePath = $request->file('image_url')->store('images/categories', 'public');
                    $category->image_url = $filePath;
                } else {
                    return back()->with('error', 'Invalid file. Please upload a valid image file.');
                }
            }
            // Handle image removal if checkbox is checked
            elseif ($request->has('remove_image') && $request->remove_image == 1) {
                if ($category->image_url && Storage::disk('public')->exists($category->image_url)) {
                    Storage::disk('public')->delete($category->image_url);
                }
                $category->image_url = null;
            }

            // Update other fields
            $category->name = $request->name;
            $category->order = $request->order;
            $category->is_active = $request->has('is_active') ? 1 : 0;

            $category->save();

            return redirect()
                ->route("admin-category")
                ->with("success", "Category updated successfully!");

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error updating category: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);

            // Delete the associated image if it exists
            if ($category->image_url && Storage::disk('public')->exists($category->image_url)) {
                Storage::disk('public')->delete($category->image_url);
            }

            // Delete the category
            $category->delete();

            return redirect()
                ->route('admin-category')
                ->with('success', 'Category deleted successfully!');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Error deleting category: ' . $e->getMessage());
        }
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
