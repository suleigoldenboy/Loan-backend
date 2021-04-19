<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'email' => 'required|unique:customers,email',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'branch_id' => 'required|max:3|numeric',
            'username' => 'min:3|unique:customers,username',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4',
            'phone_number' => 'required|regex:/(234)[0-9]{10}/|min:11|unique:customers,phone_number',
            'bvn_phone_number' => 'regex:/(234)[0-9]{10}/|min:11|unique:customers,bvn_phone_number',
            // 'avatar',
            'marital_status'  => 'string',
            'religion' => 'string',
            'date_of_birth' => 'date'
        ];
    }
}
