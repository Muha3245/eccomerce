@extends('layouts.app')

@section('admin')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Edit Role Permission</h6>
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
                    <form action="{{ route('role_has_permissions.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="role_id" class="form-label"><strong>Role:</strong></label>
                            <input type="text" class="form-control" value="{{ $role->name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="permission_id" class="form-label"><strong>Permissions:</strong></label>
                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permission_id[]" value="{{ $permission->id }}"
                                    @if (in_array($permission->id, $rolePermissions)) checked @endif>
                                    <label class="form-check-label">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('role_has_permissions.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
