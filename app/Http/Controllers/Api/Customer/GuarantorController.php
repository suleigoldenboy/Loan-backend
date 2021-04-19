<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\GuarantorRequest;
use App\User\Guarantors\CustomerGuarantor;
use Illuminate\Http\Request;

class GuarantorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource for each customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function customerGuarantors()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GuarantorRequest $request
     * @return void
     */
    public function store(GuarantorRequest $request)
    {
        CustomerGuarantor::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User\Guarantors\CustomerGuarantor  $customerGuarantor
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerGuarantor $customerGuarantor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User\Guarantors\CustomerGuarantor  $customerGuarantor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerGuarantor $customerGuarantor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User\Guarantors\CustomerGuarantor  $customerGuarantor
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerGuarantor $customerGuarantor)
    {
        //
    }
}
