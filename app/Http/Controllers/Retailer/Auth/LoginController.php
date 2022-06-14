<?php

namespace App\Http\Controllers\Retailer\Auth;

use App\Http\Controllers\Controller;
use App\Models\Retailer;
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
        $this->middleware('guest:retailer')->except('logout');
    }
    public function showLoginForm()
    {
        if (Auth::guard('retailer')->check()) {
            return redirect('/');
        } else {
            return view('backend.auth.login', ['url' => 'retailers']);
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
            $retailer = Retailer::whereUsername($request->username)->first();
            if ($retailer && Hash::check($request->password, $retailer->password) && Auth::guard('retailer')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)){

                return redirect()->intended('/');;
            }
            return redirect()->back()->withInput($request->only('username', 'remember'));
        }
    }

    public function logout(Request $request){
        Auth::guard('retailer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
