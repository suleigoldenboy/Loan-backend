<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\OfferLetter;
use App\Models\Admin\Sign;
use App\Models\Loan\Product;
use App\Models\Loan\Loan;
use App\Models\Loan\TheLoanOfferLetter;
use App\Models\Customer\Customer;
use App\Http\Helpers\AdminHelper;
use App\Mail\LoanOfferLetter;
use Illuminate\Support\Facades\Mail;
use Auth;
use Session;
use File;
//use Barryvdh\DomPDF\Facade as PDF;
use PDF;

class OfferLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
             
            $data = OfferLetter::orderBy('id','desc')->get();

            return view('admin.settings.offerletter.index', compact('data'));

        } catch (Exception $e) {
            return back();
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            
            $data = Product::orderBy('id','asc')->get();
            return view('admin.settings.offerletter.create', compact('data'));

        } catch (Exception $e) {
            return back();
        }
    }

    public static function checkIfexist($id)
    {
        return OfferLetter::where('product_id',$id)->first();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            

            $user =  new OfferLetter();
            $user->product_id =  $request->product_id;
            $user->letter = $request->letter;
            $user->user_id = Auth::user()->id;
            $user->save();
            
            //Save Audi trail
            AdminHelper::audit_trail('offerletter','New offer letter created',$user->id);
            
            Session::flash('successMessage', "Offer letter save successful");
            return redirect('admin/offer-letter');

            
        } catch (Exception $e) {
            
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
        try {
             
            $letter = OfferLetter::where('id', '=', $id)->first();
           

            return view('admin.settings.offerletter.show', compact('letter'));

        } catch (Exception $e) {
            return back();
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         try {
             
            $letter = OfferLetter::where('id', '=', $id)->first();
           

            return view('admin.settings.offerletter.edit', compact('letter'));

        } catch (Exception $e) {
            return back();
        } 
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
        try {

            OfferLetter::where('id', '=', $request->letter_id) 
                   ->update(['letter' => $request->letter]);

            //save to audit trail
            AdminHelper::audit_trail('offerletter','offer letter updated',$request->letter_id);

            Session::flash('successMessage', "Offer letter update successful");
            return back();

            
        } catch (Exception $e) {
            
        }
    }
    
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loanOfferLetter(Request $request)
    {
        try {
             
            $letter = Loan::where('id', '=', $request->id)->first();
           
    //   $pdf = PDF::loadview('accounting.loan.files.offer-letter-PDF',['letter'=>Loan::find($request->id)]);
	   //return $pdf->stream('offer_letter.pdf');
	   
          return view('accounting.loan.files.offer-letter', compact('letter'));

        } catch (Exception $e) {
            return back();
        } 
    }
    
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendOfferLetter(Request $request)
    {
        try {
            
            $result = Loan::where('id', '=', $request->id)->first();
        
            $refCode = substr(str_shuffle(str_repeat("ABCDEFGHJKLMNPRSTUVWXYZ", 5)), 0, 5);
            
           
            $check  = TheLoanOfferLetter::where('customer_id',$result->customer->id)
                                         ->where('loan_id',$request->id)->first();
                
               $obj = (object) [
                    'repayment_amount' => $request->repayment_amount,
                    'total_interest' => $request->total_interest,
                    'deduction' => $request->deduction,
                    'nex_pay_month' => $request->nex_pay_month,
                    'last_pay_month' => $request->last_pay_month
                ];
                $the_status = 'pending';
                if($result->product_id == 4){
                    $the_status = 'active';
                }
      
            if($check == null){
                
                 $oLetter =  new TheLoanOfferLetter();
                 $oLetter->customer_id =  $result->customer->id;
                 $oLetter->loan_id = $request->id;
                 $oLetter->letter_id  = $result->product->offer_letter->id;
                 $oLetter->loan_start_date = date('Y-m-d', strtotime($request->loan_start_date));
                 $oLetter->code = $refCode;
                 $oLetter->status = $the_status;
                 $oLetter->param = json_encode($obj);
                 $oLetter->send_by =  Auth::user()->id;
                 $oLetter->save();
                 //dd('ii: '.date('Y-m-d', strtotime($request->loan_start_date)));
            }else{
                TheLoanOfferLetter::where('customer_id',$result->customer->id)
                                    ->where('loan_id',$request->id)
                                     ->update(['code' => $refCode,
                                                'status' => $the_status,
                                               'loan_start_date' => date('Y-m-d', strtotime($request->loan_start_date)),
                                               'param' => json_encode($obj)]);
                                        
            }
         
            
             $data = array('subject' => "Loan Offer Letter",
            'customer_id' => $request->customer_id,
            'email' => $request->email,
            'name' => $result->customer->first_name,
            'loan_id' => $request->id,
            'code' => $refCode,
            'date' => date('d-m-Y'),
            );
    
            //Send email to customer
           // Mail::to($request->email)->send(new LoanOfferLetter($data));
            
            //Send email to loan officer
            if($result->loan_officer->email){
            // Mail::to($result->loan_officer->email)->send(new LoanOfferLetter($data));
            }
            
            Session::flash('successMessage', "Offer letter sent successful");
            return back();
        } catch (Exception $e) {
            return back();
        } 
    }
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAcceptedLetter(Request $request)
    {
        try {
             
            $letter = Loan::where('id', '=', $request->id)->first();
           
            $message = '';
            return view('accounting.loan.files.accepted-offer-letter', compact('letter','message'));

        } catch (Exception $e) {
            return back();
        } 
    }
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewOfferLetter(Request $request)
    {
        try {
             
             $data = array();
                 //Check if reques
             if (count($request->all())) {
                
                 $cus = Customer::query()->where('status', '=', 'active');
    
                 //Search by customer name
                if (isset($request->c_name)) { 
                     $cus->where('first_name', 'LIKE', "%$request->c_name%");
                     $cus->orWhere('last_name', 'LIKE', "%$request->c_name%");
                     $cus->orWhere('other_name', 'LIKE', "%$request->c_name%");
                }
                // Get the results and return them.
                $data =  $cus->get();
                
               }else{
                    $data = array();
               }
              
              
            return view('accounting.loan.files.view-offer-letter', compact('data'));

        } catch (Exception $e) {
            return back();
        } 
    }
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function signature(Request $request)
    {
        try {
             
            $data = sign::get();
           
           
            return view('admin.settings.sign.index', compact('data'));

        } catch (Exception $e) {
            return back();
        } 
    }
     /**
     * Store specified resource.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function storeSignature(Request $request)
    {
        try {
                
                $check = sign::where('name',$request->name)->first();
                if($check != null){
                     Session::flash('errorMessage', "This Name nas already been taken");
                     return back();
                }
                $_cus = new sign();
                $_cus->name = $request->name;
                $signature = '';
                if($request->hasFile('sign')){
                $signature = time().'.'.request()->sign->getClientOriginalExtension();
                request()->sign->move(public_path('staff/staffsign/'), $signature);
                }
                $_cus->sign = $signature;
                $_cus->save();
                
                Session::flash('successMessage', "Save successful");
                return back();

        } catch (Exception $e) {
            return back();
        } 
    }
    /**
     * Store specified resource.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function updateSignature(Request $request)
    {
        try {
             
                $_cus = sign::findOrFail($request->id);
                // $_cus->name = $request->name;
                $signature = '';
                if($request->hasFile('sign')){
                $signature = time().'.'.request()->sign->getClientOriginalExtension();
                request()->sign->move(public_path('staff/staffsign/'), $signature);
                }
                 $image_path1 = "staff/staffsign".$request->old_sign;  
                 if(File::exists($image_path1)) {
                    File::delete($image_path1);
                }
                $_cus->sign = $signature;
                $_cus->save();
                
                Session::flash('successMessage', "Update successful");
                return back();

        } catch (Exception $e) {
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
