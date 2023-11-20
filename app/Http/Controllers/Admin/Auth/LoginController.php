<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    protected $redirectTo = RouteServiceProvider::ADMINHOME;

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {

        if (Auth::guard('admin')->check()) {
            return redirect('/admin/dashboard');
        } else {
            return view('backend.auth.login', ['url' => 'admin']);
        }
    }

    public function login(Request $request)
    {

        $messages = array(
            'username.required' => 'You cant leave username field empty',
            'password.required' => 'You cant leave password field empty'
        );

        $rules = array(
            'username' => 'required|max:20',
            'password' => 'required'
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $auth = Admin::whereUsername($request->username)->first();
            if ($auth && Hash::check($request->password, $auth->password) && Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)){
                return redirect()->intended('/admin/dashboard');
            }
            return redirect()->back()->withInput($request->only('username', 'remember'));
        }
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
