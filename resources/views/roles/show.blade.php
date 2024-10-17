@extends('layouts.app')

@section('admin')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Role Details</h6>
                    <div class="mb-3">
                        <strong>Role Name:</strong>
                        <p>{{ $role->name }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Assigned Permissions:</strong>
                        <ul>
                            @foreach ($rolePermissions as $permission)
                                <li>{{ $permission->name }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
