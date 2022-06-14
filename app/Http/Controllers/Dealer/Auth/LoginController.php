<?php

namespace App\Http\Controllers\Dealer\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
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
        $this->middleware('guest:dealer')->except('logout');
    }
    public function showLoginForm()
    {
        if (Auth::guard('dealer')->check()) {
            return redirect('/');
        } else {
            return view('backend.auth.login', ['url' => 'dealers']);
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
            $dealer = Dealer::whereUsername($request->username)->first();
            if ($dealer && Hash::check($request->password, $dealer->password) && Auth::guard('dealer')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)){

                return redirect()->intended('/dealers/dashboard');;
            }
            return redirect()->back()->withInput($request->only('email', 'remember'));
        }
    }

    public function logout(Request $request){
        Auth::guard('dealer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
