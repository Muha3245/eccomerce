@extends('layouts.app')

@section('admin')


<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Category</h6>
                <a class="btn btn-success" href="{{ route('categories.create') }}"> Create New category</a>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0; // Initialize $i
                            @endphp
                            @foreach ($categories as $categorie)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $categorie->name }}</td>
                                <td>
                                    {{-- <a class="btn btn-info" href="{{ route('products.show', $categorie->id) }}">Show</a> --}}
                                    <a class="btn btn-primary" href="{{ route('categories.edit', $categorie->id) }}">Edit</a>
                                    <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" style="display:inline;">
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
            </div>
        </div>


    </div>
</div>

<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>

@endsection
