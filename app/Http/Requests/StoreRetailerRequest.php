<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRetailerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|unique:retailers,email',
            'password' => 'required',
            'username' => 'required|unique:retailers,username',
            'shopname' => 'required',
            'shop_location' => 'required',
            'phone' => 'required',
            'nid' => 'required|unique:retailers,nid',
            'location' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'name require',
            'email.required' => 'email require',
            'password.required' => 'password require',
            'username.required' => 'username require',
            'shopname.required' => 'shopname require',
            'shop_location.required' => 'shop location require',
            'phone.required' => 'phone require',
            'nid.required' => 'nid require',
            // 'location.required' => 'location require',
        ];
    }
}
