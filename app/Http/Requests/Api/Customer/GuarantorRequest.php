<?php

namespace App\Http\Requests\Api\Customer;

use Illuminate\Foundation\Http\FormRequest;

class GuarantorRequest extends FormRequest
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
            'email' => 'required|email:dns,spoof|unique:customer_guarantors,email',
            'title' => 'required',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'phone_number' => 'required|regex:/(0)[0-9]{9}/|min:11|unique:customer_guarantors,phone_number',
            'relationship' => 'required|string',
            'occupation' => 'string',
            'home_address' => 'required|string',
            'office_address' => 'required|string',
            'religion' => 'string',
            'nationality' => 'string',
            'state_of_origin' => 'string',
            'local_government' => 'string',
        ];
    }
}
