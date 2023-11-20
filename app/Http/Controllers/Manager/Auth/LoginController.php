<?php

namespace App\Http\Controllers\Manager\Auth;

use App\Http\Controllers\Controller;
use App\Models\Manager;
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
        $this->middleware('guest:manager')->except('logout');
    }
    public function showLoginForm()
    {
        if (Auth::guard('manager')->check()) {
            return redirect('/');
        } else {
            return view('backend.auth.login', ['url' => 'manager']);
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
            $manager = Manager::whereUsername($request->username)->first();
            if ($manager && Hash::check($request->password, $manager->password) && Auth::guard('manager')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
                return redirect()->intended('/managers/dashboard');;
            }
            return redirect()->back()->withInput($request->only('email', 'remember'));
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('manager')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}