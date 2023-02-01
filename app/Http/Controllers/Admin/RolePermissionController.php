<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles =  Role::all();
        return view('backend.pages.role_permission.index', compact('roles'));
    }

    /**
     * get permission by roles
     * @return all permissions
     */

    public function getPermissionsByRoleId($roleId)
    {
        return Role::with('permissions')->find($roleId);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::with('child')->parent()->get();
        return view('backend.pages.role_permission.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $role = new Role();
        $role->name = $request->name;
        $role->slug = Str::slug($request->name);
        $role->save();
        $role->permissions()->attach($request->permission);

        return redirect()->route('admin.role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permissionStore(Request $request)
    {
        $permission = new Permission();
        if ($request->names === null && $request->parent_id === null) {
            // dd($request->all());
            $permission->name = $request->parentName;
            $permission->slug = Str::slug($request->parentName);
            $permission->save();
        } else {
            $finalNames = explode(',', $request->names);
            // dd($request->all(), $finalNames);
            foreach ($finalNames as $key => $name) {
                $permissions[] = ['name' => $name, 'parent_id' => $request->parent_id, 'slug' => Str::slug($name)];
            }
            Permission::insert($permissions);
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}