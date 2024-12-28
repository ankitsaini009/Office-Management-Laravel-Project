<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{

    // Show all roles
    public function index(Request $request)
    {
        //dd($roles = Role::with('permissions')->get());
        if ($request->ajax()) {
            $roles = Role::with('permissions')->orderBy('id', 'desc')->get();

            return datatables()->of($roles)
                ->addIndexColumn()
                ->addColumn('permissions', function ($role) {
                    // Fetch all permissions for a specific role and format them as badges
                    return $role->permissions->pluck('name')->map(function ($permission) {
                        return '<span class="badge bg-info text-dark">' . $permission . '</span>';
                    })->join(' ');
                })
                ->addColumn('actions', function ($role) {
                    return '
                    <a href="' . route('roles.edit', $role->id) . '" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="' . route('roles.destroy', $role->id) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure?\');">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                ';
                })
                ->rawColumns(['permissions', 'actions']) // Allow HTML for permissions and actions columns
                ->make(true);
        }

        return view('admin.roles.index'); // Return the view
    }

    // Create a new role
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.add', compact('permissions'));
    }

    // Store new role
    public function store(Request $request)
    {
        //dd($request->all());
        // Common validation rules
        $validationRules = [
            'role_name' => 'required|string',
        ];

        // Extra validation for unique name when creating a new role
        if (!$request->has('role_id')) {
            $validationRules['role_name'] .= '|unique:roles,name';
        }

        $request->validate($validationRules);

        // Check if editing or creating a role
        if ($request->has('role_id') && !empty($request->role_id)) {

            // Edit existing role
            $role = Role::find($request->role_id);

            if (!$role) {
                return back()->withErrors(['role_id' => 'Role not found.']);
            }

            $role->name = $request->role_name;
            $role->guard_name = 'admin';
            $role->save();
        } else {

            // Create new role
            $role = Role::create([
                'name' => $request->role_name,
                'guard_name' => 'admin',
            ]);
        }


        // // // Retrieve and validate permissions
        // // $permissions = Permission::whereIn('name', $request->permissions)->pluck('id');

        // if ($permissions->isEmpty()) {
        //     return back()->withErrors(['permissions' => 'Invalid permissions provided.']);
        // }

        // // Sync permissions with the role
        // $role->syncPermissions($permissions);

        // Redirect to roles index page with a success message
        $message = 'Role Save successfully!';
        return redirect()->route('roles.index')->with('success', $message);
    }



    // Edit role
    public function edit(Role $role)
    {
        //dd($role);
        $permissions = Permission::all();
        return view('admin.roles.add', compact('role', 'permissions'));
    }

    // // Update role
    // public function update(Request $request, Role $role)
    // {
    //     $request->validate(['name' => 'required']);
    //     $role->update(['name' => $request->name]);

    //     return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully');
    // }

    // Delete role
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('success', 'Role deleted successfully');
    }

    // Assign permissions to role
    public function assignPermissions(Request $request, Role $role)
    {
        $role->syncPermissions($request->permissions);
        return redirect()->route('admin.roles.index')->with('success', 'Permissions assigned successfully');
    }
}
