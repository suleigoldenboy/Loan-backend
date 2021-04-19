<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer\CustomerEmployment;
use App\User\Customer\Customer;
use Exception;
use Illuminate\Http\Request;

class UserProfile extends Controller
{
    public function employmentDetails(Request $request)
    {
        try {
            CustomerEmployment::create(array_merge([
                'customer_id' => $request->user()->id
            ], $request->all()));
            Customer::findOrFail(user()->id)->update([
                'registration_step_status' => 'employment_status_updated'
            ]);
            return jsonResponse(['data' => user()->load('employment'), 'message' => 'Operation successful']);
        } catch (\Throwable $th) {
            return invalidRequest($th->getMessage());
        }
    }

    public function getUserIncome(Request $request){
        try {
            $income = user()->employment()->latest()->first()->monthly_net_pay;
            return jsonResponse(['income' => $income]);
        }catch(Exception $e){
            return invalidRequest($e->getMessage());
        }
    }

    public function customerInformation(Request $request)
    {
        try {
            Customer::findOrFail(user()->id)->update(array_merge([
                'registration_step_status' => 'user_profile_updated',
            ],$request->all()));
            return jsonResponse(['data' => user(), 'message' => 'Operation successful']);
        } catch (\Throwable $th) {
            return invalidRequest($th->getMessage());
        }
    }
}
