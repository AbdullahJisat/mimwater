<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    // public function permission()
    // {
    // 	$dev_permission = Permission::where('slug','create-tasks')->first();
	// 	$manager_permission = Permission::where('slug', 'edit-users')->first();

	// 	//RoleTableSeeder.php
	// 	$dev_role = new Role();
	// 	$dev_role->slug = 'developer';
	// 	$dev_role->name = 'Front-end Developer';
	// 	$dev_role->save();
	// 	$dev_role->permissions()->attach($dev_permission);

	// 	$manager_role = new Role();
	// 	$manager_role->slug = 'manager';
	// 	$manager_role->name = 'Assistant Manager';
	// 	$manager_role->save();
	// 	$manager_role->permissions()->attach($manager_permission);

	// 	$dev_role = Role::where('slug','developer')->first();
	// 	$manager_role = Role::where('slug', 'manager')->first();

	// 	$createTasks = new Permission();
	// 	$createTasks->slug = 'create-tasks';
	// 	$createTasks->name = 'Create Tasks';
	// 	$createTasks->save();
	// 	$createTasks->roles()->attach($dev_role);

	// 	$editUsers = new Permission();
	// 	$editUsers->slug = 'edit-users';
	// 	$editUsers->name = 'Edit Users';
	// 	$editUsers->save();
	// 	$editUsers->roles()->attach($manager_role);

	// 	$dev_role = Role::where('slug','developer')->first();
	// 	$manager_role = Role::where('slug', 'manager')->first();
	// 	$dev_perm = Permission::where('slug','create-tasks')->first();
	// 	$manager_perm = Permission::where('slug','edit-users')->first();

	// 	$developer = new Admin();
	// 	$developer->name = 'Mahedi Hasan';
	// 	$developer->email = 'mahedi@gmail.com';
	// 	$developer->password = bcrypt('secrettt');
	// 	$developer->save();
	// 	$developer->roles()->attach($dev_role);
	// 	$developer->permissions()->attach($dev_perm);

	// 	$manager = new Admin();
	// 	$manager->name = 'Hafizul Islam';
	// 	$manager->email = 'hafiz@gmail.com';
	// 	$manager->password = bcrypt('secrettt');
	// 	$manager->save();
	// 	$manager->roles()->attach($manager_role);
	// 	$manager->permissions()->attach($manager_perm);


	// 	return redirect()->back();
    // }

    public function index(Request $request)
    {
        $permissions = Permission::latest()->paginate(5);
        return view('backend.pages.permission.index',compact('permissions'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(){
        return view('backend.pages.permission.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);


        $role = new Permission();
        $role->name = $request->input('name');
        $role->slug = $request->input('slug');
        $role->save();


        return redirect()->route('permissions.index')
                        ->with('success','Permission created successfully');
    }
}
