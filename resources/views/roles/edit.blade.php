@extends('layouts.app')

@section('admin')
<div class="container-fluid pt-4 px-4 d-flex justify-content-center">
    <div class="row g-4 w-100 justify-content-center">
        <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4 text-center">Edit Role</h6>

                <div class="text-center mb-3">
                    <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
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

                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- Show the currently selected role -->
                    <div class="mb-3">
                        <label for="current_role" class="form-label"><strong>Current Role:</strong></label>
                        <input type="text" name="name" value="{{ $role->name }}" class="form-control" required>
                    </div>

                    <!-- Permissions selection -->
                    <div class="mb-3">
                        <label for="permissions" class="form-label"><strong>Assign Permissions:</strong></label>
                        @foreach ($permissions as $perm)
                            <div class="form-check">
                                <input
                                    {{ ($haspermissions->contains($perm->name)) ? 'checked' : '' }}
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permission[]"
                                    value="{{ $perm->name }}"
                                    id="permission{{ $perm->id }}">
                                <label class="form-check-label" for="permission{{ $perm->id }}">
                                    {{ $perm->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Role</button>
                    </div>
                </form>

                <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
            </div>
        </div>
    </div>
</div>
@endsection
