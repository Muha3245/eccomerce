<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Item;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('subcategory')->paginate(10);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $subcategories = Subcategory::all();
        return view('items.create', compact('subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'subcategory_id' => 'required',
            'sizes' => 'required|array',
            'sizes.*' => 'in:XL,L,M,S',
            'description' => 'required',
        ]);

        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');
            $extension = $mainImage->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $mainImage->storeAs('public/items', $filename);
        }

        Item::create([
            'title' => $request->title,
            'main_image' => $filename,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'subcategory_id' => $request->subcategory_id,
            'sizes' => json_encode($request->sizes),
            'additional_information' => $request->additional_information,
            'description' => $request->description,
        ]);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function edit(Item $item)
    {
        $subcategories = Subcategory::all();
        return view('items.edit', compact('item', 'subcategories'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'title' => 'required',
            'main_image' => 'image|mimes:jpeg,png,jpg,gif',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'subcategory_id' => 'required',
            'sizes' => 'required|array',
            'sizes.*' => 'in:XL,L,M,S',
            'description' => 'required',
        ]);

        $filename = $item->main_image;

        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');
            $extension = $mainImage->getClientOriginalExtension();
            $filename = time() . '.' . $extension;

            if ($item->main_image) {
                Storage::delete('public/items/' . $item->main_image);
            }

            $mainImage->storeAs('public/items', $filename);
        }

        $item->update([
            'title' => $request->title,
            'price' => $request->price,
            'main_image' => $filename,
            'quantity' => $request->quantity,
            'subcategory_id' => $request->subcategory_id,
            'sizes' => json_encode($request->sizes),
            'additional_information' => $request->additional_information ?? '',
            'description' => $request->description,
        ]);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        if ($item->main_image) {
            Storage::delete('public/items/' . $item->main_image);
        }
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
