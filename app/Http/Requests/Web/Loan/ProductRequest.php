<?php

namespace App\Http\Requests\Web\Loan;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|',
            'interest_rate' => 'required|numeric|between:0,99.99',
            'minimum_principal' => 'required|numeric',
            'maximum_principal' => 'required|numeric',
            'processing_charge' => 'required|numeric|between:0,99.99',
            'insurance_charge' => 'required|numeric|between:0,99.99',
            'loan_duration' => 'required',
            'loan_duration_length' => 'required',
            'repayment_method' => 'required|string',
            'interest_method' => 'required|string',
            'late_repayment_penalty_amount' => 'required|numeric|between:0,99.99',
            'after_maturity_date_penalty_amount' => 'required|numeric',
            'early_repayment_charge' => 'required|numeric|between:0,99.99',
            'status' => 'required|numeric|between:0,99.99',
        ];
    }
}
