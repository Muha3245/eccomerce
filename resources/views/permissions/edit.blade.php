@extends('layouts.app')

@section('admin')

<div class="container-fluid pt-4 px-4 d-flex justify-content-center">
    <div class="row g-4 w-100 justify-content-center">
        <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4 text-center">Edit Product</h6>

                <div class="text-center mb-3">
                    <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Product Name Input -->
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label for="name" class="form-label"><strong>Product Name:</strong></label>
                            <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">
                        </div>
                    </div>

                    <!-- Product Detail Input -->
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label for="detail" class="form-label"><strong>Detail:</strong></label>
                            <textarea class="form-control" name="detail" placeholder="Detail" style="height: 150px">{{ $product->detail }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3 text-center">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>

                <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
            </div>
        </div>
    </div>
</div>

@endsection
