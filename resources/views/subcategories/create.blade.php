@extends('layouts.app')

@section('admin')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Create New Subcategory</h6>
                <form action="{{ route('subcategories.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Subcategory Name:</label>
                        <input type="text" name="name" class="form-control" placeholder="Subcategory Name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="category">Category:</label>
                        <select name="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
