<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.permission.view-permission', compact('roles', 'permissions'));
    }

    /**
     * Ajax request handler
    */
    public function assignPermission (Request $request)
    {
        $permission = Permission::find($request->permission_id);
        $roles = Role::find($request->role_id);
        if($request->ajax()) {
            if($request->check_permission == "true") {
                // dd($roles);
                $roles->permissions()->attach($permission->id);
                $result = [
                    '<div class="alert alert-success fade show" id="alert-box" role="alert">
                        <strong>Success!</strong> Permission Granted.!!
                        <div class="float-end">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    </div>'
                ];
                return response()->json($result);
            }
            else {
                $roles->permissions()->detach($permission->id);
                $result = [
                    '<div class="alert alert-danger fade show" id="alert-box" role="alert">
                        <strong>Warning!</strong> Permission Denied.!!
                        <div class="float-end">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>'
                ];
                return response()->json($result);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
