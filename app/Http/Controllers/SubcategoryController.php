<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category; // Import the Category model for category dropdown
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    // Show the list of subcategories
    public function index()
    {
        $subcategories = Subcategory::with('category')->paginate(10); // Fetch subcategories with their categories
        return view('subcategories.index', compact('subcategories'));
    }

    // Show the form for creating a new subcategory
    public function create()
    {
        $categories = Category::all(); // Fetch all categories for the dropdown
        return view('subcategories.create', compact('categories'));
    }

    // Store a newly created subcategory
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        Subcategory::create($request->all());

        return redirect()->route('subcategories.index')
                        ->with('success', 'Subcategory created successfully.');
    }

    // Show the form for editing an existing subcategory
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all(); // Fetch all categories for the dropdown
        return view('subcategories.edit', compact('subcategory', 'categories'));
    }

    // Update an existing subcategory
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        $subcategory->update($request->all());

        return redirect()->route('subcategories.index')
                        ->with('success', 'Subcategory updated successfully.');
    }

    // Delete a subcategory
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();

        return redirect()->route('subcategories.index')
                        ->with('success', 'Subcategory deleted successfully.');
    }
}
