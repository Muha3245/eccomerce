<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
{
    // Fetch users with roles by joining the model_has_roles table
    $data = DB::table('users')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->select('users.*', DB::raw('GROUP_CONCAT(roles.name) as role_names'))
        ->where('model_has_roles.model_type', User::class) // Ensure it's fetching user roles
        ->groupBy('users.id') // Group by user ID
        ->orderBy('users.id', 'DESC') // Order by user ID in descending order
        ->paginate(10); // Paginate results, 10 per page
        // dd($data);

    // Return the users index view with data and pagination index
    return view('admin.users.index', compact('data'))
        ->with('i', ($request->input('page', 1) - 1) * 10); // Adjust index for pagination links

}

    public function create()
    {
        // Fetch all roles
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashing password
        ]);

        // Assign roles to the user
        $user->assignRole($request->roles);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        // Fetch all roles and the current user's roles
        $roles = Role::all();
        $userRole = $user->roles->pluck('id')->toArray(); // Getting role IDs for the user

        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, User $user)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
        'roles' => 'required|array',
        'roles.*' => 'exists:roles,id',
    ]);

    // Update user details
    $user->name = $request->name;
    $user->email = $request->email;

    // If the password is provided, hash and update it
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    // Sync roles (assign multiple roles)
    $roles = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
    $user->syncRoles($roles); // Corrected this line to pass the entire array

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}

    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
}
