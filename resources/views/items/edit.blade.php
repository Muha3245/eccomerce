@extends('layouts.app')

@section('admin')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Edit Item</h6>
                <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="title">Title:</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $item->title) }}" placeholder="Item Title">
                    </div>

                    <div class="form-group mb-3">
                        <label for="main_image">Main Image:</label>
                        <input type="file" name="main_image" class="form-control">
                        @if($item->main_image)
                        <img src="{{ asset('/storage/items/' . $item->main_image )}}" width="50" alt="Main Image">
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="price">Price:</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $item->price) }}" placeholder="Item Price">
                    </div>

                    <div class="form-group mb-3">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $item->quantity) }}" placeholder="Item Quantity">
                    </div>

                    <div class="form-group mb-3">
                        <label for="sizes">Sizes:</label>
                        <select name="sizes[]" class="form-control" multiple>
                            @php
                                $sizesArray = is_array(json_decode($item->sizes)) ? json_decode($item->sizes) : [];
                            @endphp
                            <option value="XL" {{ in_array('XL', $sizesArray) ? 'selected' : '' }}>XL</option>
                            <option value="L" {{ in_array('L', $sizesArray) ? 'selected' : '' }}>L</option>
                            <option value="M" {{ in_array('M', $sizesArray) ? 'selected' : '' }}>M</option>
                            <option value="S" {{ in_array('S', $sizesArray) ? 'selected' : '' }}>S</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="subcategory_id">Subcategory:</label>
                        <select name="subcategory_id" class="form-control">
                            <option value="">Select Subcategory</option>
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}" {{ $subcategory->id == $item->subcategory_id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Description:</label>
                        <textarea name="description" class="form-control" placeholder="Item Description">{{ old('description', $item->description) }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="additional_information">Additional Information:</label>
                        <textarea name="additional_information" class="form-control" placeholder="Additional Information">{{ old('additional_information', $item->additional_information) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
