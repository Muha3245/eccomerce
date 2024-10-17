@extends('layouts.app')

@section('admin')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Subcategories</h6>
                <a class="btn btn-success mb-3" href="{{ route('subcategories.create') }}">Create New Subcategory</a>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($subcategories as $subcategory)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $subcategory->name }}</td>
                                <td>{{ $subcategory->category->name ?? 'N/A' }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('subcategories.edit', $subcategory->id) }}">Edit</a>
                                    <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $subcategories->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
