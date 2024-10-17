@extends('layouts.app')

@section('admin')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Create New Item</h6>
                <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title">Title:</label>
                        <input type="text" name="title" class="form-control" placeholder="Item Title">
                    </div>

                    <div class="form-group mb-3">
                        <label for="main_image">Main Image:</label>
                        <input type="file" name="main_image" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="price">Price:</label>
                        <input type="number" name="price" class="form-control" placeholder="Item Price">
                    </div>

                    <div class="form-group mb-3">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" class="form-control" placeholder="Item Quantity">
                    </div>

                    <!-- Modified Sizes Section for Multiple Selection -->
                    <div class="form-group mb-3">
                        <label for="sizes">Sizes:</label>
                        <select name="sizes[]" class="form-control" multiple>
                            <option value="XL" {{ is_array(old('sizes')) && in_array('XL', old('sizes')) ? 'selected' : '' }}>XL</option>
                            <option value="L" {{ is_array(old('sizes')) && in_array('L', old('sizes')) ? 'selected' : '' }}>L</option>
                            <option value="M" {{ is_array(old('sizes')) && in_array('M', old('sizes')) ? 'selected' : '' }}>M</option>
                            <option value="S" {{ is_array(old('sizes')) && in_array('S', old('sizes')) ? 'selected' : '' }}>S</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="subcategory_id">Subcategory:</label>
                        <select name="subcategory_id" class="form-control">
                            <option value="">Select Subcategory</option>
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Description:</label>
                        <textarea name="description" class="form-control" placeholder="Item Description"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="additional_information">Additional Information:</label>
                        <textarea name="additional_information" class="form-control" placeholder="Additional Information"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
