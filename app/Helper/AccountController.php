<?php

namespace App\Http\Controllers;

use App\Models\ClientAccountInfoModel;
use App\Models\ClientRegisterModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AccountController extends Controller
{
    function AccountCreate()
    {
        return view('account.account-form');
    }

    function AccountDetailsStore(Request $request)
    {


        $request->validate([

            'account_holder' => 'required',
            'bank_name' => 'required',
            'branch_name' => 'required',
            'account_no' => 'required',
            'country' => 'required',
            'note' => 'required',

        ]);


        ClientAccountInfoModel::insert([

            'client_register_id' => \Auth::id(),
            'account_holder' => $request->account_holder,
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'iban_ifsc_code' => $request->iban_ifsc_code,
            'account_no' => $request->account_no,
            'swift_code' => $request->swift_code,
            'country' => $request->country,
            'note' => $request->note,

        ]);

        return redirect()->back()->with('message', 'Account Details Has Been Updated ');

    }

    function PasswordChangePage()
    {
        return view('account.password-change');
    }

    function UpdatePassword(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required| min:4',
            'password_confirmation' => 'required|same:new_password|min:4'
        ]);

        $db_pass = \Auth::user()->password;
        $current_pass = $request->old_password;
        $new_pass = $request->new_password;
        $confirm_pass = $request->password_confirmation;
        //password_confirmation

        if (Hash::check($current_pass, $db_pass)) {
            if ($new_pass === $confirm_pass) {
                ClientRegisterModel::where('id', \Auth::id())->update([
                    'password' => Hash::make($new_pass)
                ]);
                \Auth::logout();
            }
            return redirect()->back();
        } else {
            $msg = "New password and confirm password are not same";
            return redirect()->back()->with('message', $msg);
        }

    }

    function ProfileChangePage()
    {

        $data['single'] = ClientRegisterModel::where('id', \Auth::id())->first();
        return view('account.profile-change', $data);
    }

    function UpdateProfile(Request $request)
    {
        $request->validate([

            'email' => 'required',
            'phone' => 'required'
        ]);
        ClientRegisterModel::where('id', \Auth::id())->update([

            'email' => $request->email,
            'phone' => $request->phone,
            'updated_at' => Carbon::now()

        ]);
        return redirect()->back()->with('message', 'Your Profile Updated');

    }


    function UpdateImage(Request $request)
    {

        $request->validate([
            'image' => 'required',

        ]);
        $old_image = $request->old_image;

        if (\Auth::user()->image == null) {

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image_path = "uploads/client-img/" . $name_gen;
            Image::make($image)->resize(300, 300)->save($image_path);
            $save_url = $image_path;
            ClientRegisterModel::where('id', \Auth::id())->update([
                'image' => $save_url
            ]);
            return redirect()->back()->with('message', 'Your Image Updated');
        } else {

            unlink($old_image);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image_path = "uploads/client-img/" . $name_gen;
            Image::make($image)->resize(300, 300)->save($image_path);
            $save_url = $image_path;
            ClientRegisterModel::where('id', \Auth::id())->update([
                'image' => $save_url
            ]);

            return redirect()->back()->with('message', 'Your Image Updated');
        }


    }

    function AccountView(){

        $data['account']=ClientAccountInfoModel::where('client_register_id',\Auth::id())->first();
        return view('account.account-view',$data);
    }


}
