<?php

namespace App\Http\Controllers\Loan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Loan\Product;
use App\Http\Helpers\AdminHelper;
use App\Http\Requests\Web\Loan\ProductRequest;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::get();
        return view('accounting.product.index', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounting.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try{
            $product = Product::create($request->all());
            AdminHelper::audit_trail('loan_product','New Product created',$product->id);
            return appRedirect([], 'product.index', ['successMessage', message('response.product.create')], $request);
        }catch (\Exception $e) {
            $request->session()->flash('errorMessage', $e->getMessage(),' ',message('response.error500'));
           return back();
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Product::findOrFail($id);

        return view('accounting.product.edit', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{

            Product::where('id', $request->id)
                        ->update([
                                'name' => $request->name,
                                'minimum_principal' => $request->minimum_principal,
                                'maximum_principal' => $request->maximum_principal,
                                'interest_method' => $request->interest_method,
                                'interest_rate' => $request->interest_rate,
                                'loan_duration' => $request->loan_duration,
                                'repayment_method' => $request->repayment_method,
                                'enable_late_repayment_penalty' => $request->enable_late_repayment_penalty,
                                'enable_after_maturity_date_penalty' => $request->enable_after_maturity_date_penalty,
                                'late_repayment_penalty_amount' => $request->late_repayment_penalty_amount,
                                'after_maturity_date_penalty_amount' => $request->after_maturity_date_penalty_amount,]);


            AdminHelper::audit_trail('loan_product','Product Updated',$request->id);

            return response()->json([], 201);
            return back();

        }catch (\Exception $e) {
           return back();
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
