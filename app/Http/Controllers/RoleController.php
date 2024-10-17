<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('roles.create', [
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
        ]);

        if ($validator->passes()) {
            $role = Role::create(['name' => $request->name]);

            if (!empty($request->permission)) {
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }

            return redirect()->route('roles.index')
                ->with('success', 'Role created successfully');
        }

        return redirect()->back()->withErrors($validator)->withInput();
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $haspermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name', 'ASC')->get();



        return view('roles.edit', compact('role', 'haspermissions', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id,
        ]);

        if ($validator->passes()) {
            $role->name = $request->name;
            $role->save();

            if (!empty($request->permission)) {

                    $role->syncPermissions($request->permission);

            }


            return redirect()->route('roles.index')
                ->with('success', 'Role updated successfully');
        }
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
    public function show($id)
{
    // Fetch the role by ID
    $role = Role::findOrFail($id);

    // Get the permissions assigned to the role
    $rolePermissions = $role->permissions()->orderBy('name', 'ASC')->get();

    // Return the view with role and its permissions
    return view('roles.show', compact('role', 'rolePermissions'));
}

}
