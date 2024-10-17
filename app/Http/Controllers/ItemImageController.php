<?php

namespace App\Http\Controllers;

use App\Models\ItemImage;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemImageController extends Controller
{
    public function index()
    {
        $itemImages = ItemImage::with('item')->paginate(10);
        return view('item_images.index', compact('itemImages'));
    }

    public function create()
    {
        $items = Item::all();
        return view('item_images.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        foreach ($request->file('images') as $image) {
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '.' . $extension;
            $imagePath = $image->storeAs('public/item_images', $filename);

            ItemImage::create([
                'item_id' => $request->item_id,
                'image' => $filename,
            ]);
        }

        return redirect()->route('item_images.index')->with('success', 'Images added successfully.');
    }

    public function edit(ItemImage $itemImage)
    {
        $items = Item::all();
        return view('item_images.edit', compact('itemImage', 'items'));
    }

    public function update(Request $request, ItemImage $itemImage)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $itemImage->item_id = $request->item_id;

        if ($request->hasFile('images')) {
            Storage::disk('public')->delete('item_images/' . $itemImage->image);

            foreach ($request->file('images') as $image) {
                $extension = $image->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $imagePath = $image->storeAs('public/item_images', $filename);
                $itemImage->image = $filename;
            }
        }

        $itemImage->save();

        return redirect()->route('item_images.index')->with('success', 'Image updated successfully.');
    }

    public function destroy(ItemImage $itemImage)
    {
        Storage::disk('public')->delete('item_images/' . $itemImage->image);
        $itemImage->delete();

        return redirect()->route('item_images.index')->with('success', 'Image deleted successfully.');
    }
}
