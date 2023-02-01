<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use DB;
use Hash;
use Str;
use Illuminate\Support\Arr;

class AdminController extends Controller
{
    public function __construct()
    {
        // $this->middleware('role_custom:new-demo');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth('admin')->user()->can('create-dealer')) {
            // if (auth('admin')->user()->can('add-retailer')) {
            // abort_if(auth('admin')->user()->can('edit-dealer'), 403);
            // abort_if(auth('admin')->user()->can('create-dealer'), 403);
            // $user = \Auth::user();
            // assign role
            // $role = Role::where('slug','editor')->first();
            // $user->roles()->attach($role);
            // dd($user->hasRole('author'));
            //
            // check permission
            // $permission = Permission::first();
            // $user->permissions()->attach($permission);
            // dd($user->permissions);
            // dd($user->can('add-post'));
            //
            //
            //
            //
            // dd($user->roles);
            // dd(auth('admin')->user()->can('create-admin'));
            $admins = Admin::with('rolesa')->orderBy('id', 'DESC')->paginate(5);
            // dd($admins[0]->rolesa);
            // dd($admins[0]->hasRole('admin')); //will return true, if user has role
            // dd($admins[0]->givePermissionsTo('create-admin'), 'hello');// will return permission, if not null
            // dd($admins[0]->can('create-admin'));
            // $admins = Admin::with('roles')->orderBy('id', 'DESC')->get();
            return view('backend.pages.admin.index', compact('admins'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        } else {
            echo 404;
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $roles = Role::pluck('name','name')->all(); //output admin => admin
        $roles = Role::all();
        return view('backend.pages.admin.create', compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required|email|unique:admin,email',
        //     'password' => 'required|same:confirm-password',
        //     'roles' => 'required'
        // ]);


        $input = $request->all();
        // dd($input);
        // $input['password'] = FacadesHash::make($request->password);


        $admin = new Admin();
        $admin->name = $input['name'];
        $admin->email = $input['email'];
        $admin->username = Str::slug($input['name']);
        $admin->password = Hash::make($input['password']);
        $admin->save();
        $admin->roles()->attach($request->roles);
        $roles = Role::with('permissions')->find($request->roles);
        // dd($roles);
        $permissions = [];
        foreach ($roles as $key => $role) {
            foreach ($role->permissions as $key => $permission) {
                if (!in_array($permission->id, $permissions)) {
                    $permissions[] = $permission->id;
                }
            }
        }
        // dd($permissions);
        // $permissions = $admin->roles()->with('permissions')->find($request->roles);
        // dd($permissions()->permissions);
        // dd(Admin::with('roles', 'permissions')->first());
        $admin->permissions()->attach($permissions);


        return redirect()->route('admins.index')
            ->with('success', 'Admin created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Admin = Admin::find($id);
        return view('admin.show', compact('Admin'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::with('roles', 'permissions')->find($id);
        $roles = Role::all();
        return view('backend.pages.admin.edit', compact('roles', 'admin'));
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
        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required|email|unique:admin,email,' . $id,
        //     'password' => 'same:confirm-password',
        //     'roles' => 'required'
        // ]);


        // $input = $request->all();
        // if (!empty($input['password'])) {
        //     $input['password'] = Hash::make($input['password']);
        // } else {
        //     $input = array_except($input, array('password'));
        // }

        $input = $request->all();

        $admin = Admin::find($id);
        $admin->roles()->detach($admin->roles);
        $admin->permissions()->detach($admin->permissions);
        $admin->name = $input['name'];
        $admin->email = $input['email'];
        $admin->username = Str::slug($input['name']);
        $admin->password = Hash::make($input['password']) ?? $admin->password;
        $admin->save();
        $admin->roles()->attach($request->roles);
        $roles = Role::with('permissions')->find($request->roles);
        $permissions = [];
        foreach ($roles as $key => $role) {
            foreach ($role->permissions as $key => $permission) {
                if (!in_array($permission->id, $permissions)) {
                    $permissions[] = $permission->id;
                }
            }
        }
        $admin->permissions()->attach($permissions);

        return redirect()->route('admins.index')
            ->with('success', 'Admin updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->roles()->detach($admin->roles);
        $admin->permissions()->detach($admin->permissions);
        $admin->delete();
        return back()
            ->with('success', 'Admin deleted successfully');
    }
}