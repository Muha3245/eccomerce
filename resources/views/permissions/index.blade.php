@extends('layouts.app')

@section('admin')


<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Permissions</h6>
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Permission</a>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Details</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->detail }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('products.show', $permission->id) }}">Show</a>
                                    <a class="btn btn-primary" href="{{ route('products.edit', $permission->id) }}">Edit</a>
                                    <form action="{{ route('products.destroy', $permission->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $permissions->onEachSide(1)->links('pagination::bootstrap-4') !!}
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Products</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Details</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->detail }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Show</a>
                                    <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $products->onEachSide(1)->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>

<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>

@endsection
