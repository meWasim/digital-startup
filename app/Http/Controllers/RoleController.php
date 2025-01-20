<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of roles.
     */
    public function index()
    {
        if (!auth()->user()->can('view-roles')) {
            return redirect()->back()->with('error', 'Permission denied');
        }
        $roles = Role::with('permissions')->get(); // Eager load permissions
        return view('role-permission.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        if (!auth()->user()->can('create-roles')) {
            return redirect()->back()->with('error', 'Permission denied');
        }
        $permissions = Permission::all(); // Fetch all permissions
        return view('role-permission.role.create', compact('permissions'));
    }

    /**
     * Store a newly created role in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
        ]);

        // Create the role with guard_name set to 'web'
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        // Assign permissions to the role
        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit($id)
    {
        if (!auth()->user()->can('edit-roles')) {
            return redirect()->back()->with('error', 'Permission denied');
        }
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::all(); // Fetch all permissions
        $assignedPermissions = $role->permissions->pluck('id')->toArray(); // Array of assigned permission IDs

        return view('role-permission.role.edit', compact('role', 'permissions', 'assignedPermissions'));
    }

    /**
     * Update the specified role in the database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'permissions' => 'nullable|array',
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->name,
            'guard_name' => 'web', // Ensure guard_name is set
        ]);

        // Update permissions assigned to the role
        $role->permissions()->sync($request->permissions ?? []);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    }

    /**
     * Remove the specified role from the database.
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('delete-roles')) {
            return redirect()->back()->with('error', 'Permission denied');
        }
        $role = Role::findOrFail($id);

        // Detach all permissions before deleting the role
        $role->permissions()->detach();
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
    }
}
