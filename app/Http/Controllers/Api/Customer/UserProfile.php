<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer\CustomerEmployment;
use App\User\Customer\Customer;
use Illuminate\Http\Request;

class UserProfile extends Controller
{
    public function employmentDetails(Request $request)
    {
        try {
            CustomerEmployment::create(array_merge(['customer_id' => $request->user()->id], $request->all()));
            return jsonResponse(['message' => 'Operation successful']);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function customerInformation(Request $request)
    {
        try {
            Customer::findOrFail(user()->id)->update($request->all());
            return jsonResponse(['message' => 'Operation successful']);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
