@extends('layouts.app')

@section('admin')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4 text-center">Add New Product</h6>

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

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input type="text" name="name" class="form-control" placeholder="Name">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-group">
                                <strong>Detail:</strong>
                                <textarea class="form-control" style="height: 150px" name="detail" placeholder="Detail"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 text-center">
                        <div class="col-12">
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
