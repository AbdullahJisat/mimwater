<?php

namespace App\Http\Controllers\Office\Auth;

use App\Http\Controllers\Controller;
use App\Models\OfficeUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // protected $redirectTo = RouteServiceProvider::ADMINHOME;
    protected $redirectTo = '/';

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        $this->middleware('guest:office_user')->except('logout');
    }
    public function showLoginForm()
    {
        if (Auth::guard('office_user')->check()) {
            return redirect('/');
        } else {
            return view('backend.auth.login', ['url' => 'office_user']);
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
            $office_user = OfficeUser::whereUsername($request->username)->first();
            if ($office_user && Hash::check($request->password, $office_user->password) && Auth::guard('office_user')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
                
        
                return redirect()->intended('/office_users/dashboard');;
            }
            return redirect()->back()->withInput($request->only('email', 'remember'));
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('office_user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}