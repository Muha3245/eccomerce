@extends('layouts.app')



@section('admin')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New User</a>
        </div>
    </div>
</div>



@if ($message = Session::get('success'))

    <div class="alert alert-success">

        <p>{{ $message }}</p>

    </div>

@endif
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Roles</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>No</th>
                                <th>Name</th>
                                <th>permissions</th>
                                <th width="280px">Action</th>

                             </tr>
                        </thead>

                        <tbody>
                            @foreach ($roles as $key => $role)
                            <tr>

                                <td>{{ ++$i }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>

                                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>




                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline">
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




{!! $roles->onEachSide(1)->links('pagination::bootstrap-4') !!}



{{-- <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p> --}}

@endsection
