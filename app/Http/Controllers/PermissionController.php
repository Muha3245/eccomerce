<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission as ModelsPermission;

class PermissionController extends Controller
{
    // Index method remains unchanged
    public function index()
    {
        // Fetch permissions
        $permissions = ModelsPermission::latest()->paginate(5);

        // Fetch permissions
        $products = Permission::latest()->paginate(5);

        return view('permissions.index', compact('permissions', 'products'))
            ->with('i', (request()->input('page') - 1) * 5);
    }

    // Create method remains unchanged
    public function create()
    {
        return view('permissions.create');
    }

    // Store method with validation and product creation
    public function store(Request $request)
    {
        // Validate only 'name' and 'detail' for the product
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        // Store product data
        Permission::create($request->only(['name', 'detail']));
        ModelsPermission::create($request->only(['name']));

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    // Show method remains unchanged
    public function show(Permission $product)
    {
        return view('permissions.show', compact('product'));
    }

    // Edit method remains unchanged
    public function edit(Permission $product)
    {
        return view('permissions.edit', compact('product'));
    }

    // Update method with validation and product update
    public function update(Request $request, Permission $product)
    {
        // Validate only 'name' and 'detail' for the product
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        // Update product data
        $product->update($request->only(['name', 'detail']));

        return redirect()->route('permissions.index')
            ->with('success', 'Product updated successfully');
    }

    // Destroy method remains unchanged
    public function destroy(Permission $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
