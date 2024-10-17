<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleHasPermissionController extends Controller
{
    public function index()
    {
        // Fetch roles with their permissions
        $roles = Role::with('permissions')->latest()->paginate(5);
        return view('role_has_permissions.index', compact('roles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        // Fetch all roles and permissions for the create view
        $roles = Role::all();
        $permissions = Permission::all();
        return view('role_has_permissions.create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|array',
            'permission_id.*' => 'exists:permissions,id',
        ]);

        // Assign permissions to the role
        $role = Role::find($request->role_id);
        $role->givePermissionTo($request->permission_id);

        return redirect()->route('role_has_permissions.index')
            ->with('success', 'Role permissions created successfully.');
    }

    public function edit($id)
    {
        // Fetch role and its permissions for the edit view
        $role = Role::find($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray(); // Get assigned permission IDs

        return view('role_has_permissions.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'permission_id' => 'required|array',
            'permission_id.*' => 'exists:permissions,id',
        ]);

        // Update role permissions
        $role = Role::find($id);
        $role->syncPermissions($request->permission_id); // Sync permissions

        return redirect()->route('role_has_permissions.index')
            ->with('success', 'Role permissions updated successfully.');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->revokePermissionTo($role->permissions); // Revoke all permissions

        return redirect()->route('role_has_permissions.index')
            ->with('success', 'Role permissions deleted successfully.');
    }
}
