@extends('layouts.app')

@section('admin')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Role: {{ $role->name }}</h6>
                    <h6 class="mb-4">Permissions:</h6>
                    <ul>
                        @foreach ($rolePermissions as $permission)
                            <li>{{ $permission->name }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ route('role_has_permissions.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
