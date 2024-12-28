<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // Show all permissions
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Permission::all();
            return datatables()->of($roles)
                ->addIndexColumn()->addColumn('actions', function ($role) {
                    return '
                    <a href="' . route('permissions.edit', $role->id) . '" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="' . route('permissions.destroy', $role->id) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure?\');">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                ';
                })
                ->rawColumns(['actions']) // Allow HTML for permissions and actions columns
                ->make(true);
        }

        return view('admin.permissions.index'); // Return the view
    }

    // Show create form
    public function create()
    {
        return view('admin.permissions.add');
    }

    // Store new permission
    public function store(Request $request)
    {
        //dd($request->all());
        // Check if this is an edit operation
        if ($request->has('permission_id') && $request->permission_id) {
            $request->validate([
                'Permission_name' => 'required',
            ]);
            // Edit existing permission
            $permission = Permission::findOrFail($request->permission_id);
            $permission->update([
                'name' => $request->Permission_name,
                'guard_name' => 'web',
            ]);
            $message = 'Permission updated successfully!';
        } else {
            $request->validate([
                'Permission_name' => 'required|string|unique:permissions,name',
            ]);
            // Add new permission
            Permission::create([
                'name' => $request->Permission_name,
                'guard_name' => 'web',
            ]);
            $message = 'Permission added successfully!';
        }

        // Redirect back to permissions index with success message
        return redirect()->route('permissions.index')->with('success', $message);
    }

    // Show edit form
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.add', compact('permission'));
    }

    // Update permission
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $id,
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully!');
    }

    // Delete permission
    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully!');
    }
}
