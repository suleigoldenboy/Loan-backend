<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\OfferLetter;
use App\Models\Loan\Product;
use App\Models\Loan\Loan;
use App\Models\Loan\TheLoanOfferLetter;
use App\Models\Customer\Customer;
use App\Http\Helpers\AdminHelper;
use App\Mail\LoanOfferLetter;
use Illuminate\Support\Facades\Mail;
use Auth;
use Session;
use PDF;
use File;

class UserOfferLetterController extends Controller
{
    /**
     * Confirm Offer letter  
     * 
     * customer-offer-letter-pdf.blade.php
     * customer-application-form.blade.php
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmLetter(Request $request)
    {
        try {
            
            $email = $request->email;
            $customer_id = $request->customer;
            $loan_id = $request->theloan;
            $code = $request->ref;
            
            

           
           $check  = TheLoanOfferLetter::where('customer_id',$request->customer)
                                          ->where('loan_id',$request->theloan)->first();
             
            if($check != null){
               
                if($check->status == "active"){
                    
                    $message = 'Thank you for accepting the offer letter.';
                    return view('customer.offer-accepted', compact('message'));
                }
                
                 $letter = Loan::where('id', '=', $loan_id)
                            ->where('customer_id', '=', $customer_id)->first();
                
                $message = '';
                 return view('customer.show-offerletter', compact('letter','message','customer_id','loan_id'));
                 
            }else{
             
              return redirect('/');
            }
           
          

        } catch (Exception $e) {
        
             return redirect('/');
        }
        
    }
    
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadOfferLetter(Request $request)
    {
        try {
           
             
            $letter = Loan::where('id', '=', $request->id)->first();
           
            $pdf = PDF::loadview('customer.customer-offer-letter-pdf',['letter'=>Loan::find($request->id)]);
	        return $pdf->stream('offer_letter.pdf');

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
    public function downloadApplicationForm(Request $request)
    {
        try {
             
            $letter = Loan::where('id', '=', $request->id)->first();
           
            $pdf = PDF::loadview('customer.customer-application-form',['letter'=>Loan::find($request->id)]);
        	return $pdf->stream('offer_letter.pdf');

        } catch (Exception $e) {
            return back();
        } 
    }
      /**
     * Confirm Offer letter
     *
     * @return \Illuminate\Http\Response
     */
    public function offerCompleted(Request $request)
    {
        try {
            
            $message = 'Thank you for accepting the offer letter.';
            return view('customer.offer-accepted', compact('message'));
            
        }catch(Exception $e){
             return back();
        }
    }
    
    
     /**
     * Confirm Offer letter
     *
     * @return \Illuminate\Http\Response
     */
    public function storeConfirmLetter(Request $request)
    {
        try {
            
            // $email = $request->email;
            // $customer_id = $request->customer_id;
            // $loan_id = $request->loan_id;
            // $code = $request->ref;
            
        $check  = TheLoanOfferLetter::where('customer_id',$request->customer_id)
                                          ->where('loan_id',$request->loan_id)
                                          //->where('code',$request->code)
                                          ->first();
        
        if($check != null){

                    $offerLetter = '';
                    if($request->hasFile('offer_letter')){ 
                    $offerLetter = time().'idc.'.request()->offer_letter->getClientOriginalExtension();
                    request()->offer_letter->move(public_path('customerfiles/offerletters/'), $offerLetter);
                    $path_old_letter = "customerfiles/offerletters/".$request->old_offer_letter;  
                        if(File::exists($path_old_letter)) {
                            File::delete($path_old_letter);
                        }
                     $check->img_offer_letter = $offerLetter;
                    }
                    $applicationForm = '';
                    if($request->hasFile('application_form')){ 
                    $applicationForm = time().'bnks.'.request()->application_form->getClientOriginalExtension();
                    request()->application_form->move(public_path('customerfiles/applicationform/'), $applicationForm);
                    $path_old_application_form = "customerfiles/applicationform/".$request->old_application_form;  
                        if(File::exists($path_old_application_form)) {
                            File::delete($path_old_application_form);
                        }
                     $check->img_application_form = $applicationForm;
                    }
                    $check->status = 'active';
                    $check->save();
            
            // TheLoanOfferLetter::where('customer_id',$request->customer_id)
            //                         ->where('loan_id',$request->loan_id)
            //                          ->update(['status' => 'active']);
          
            return redirect('/offer/accepted/completed');
            // $message = 'Thank you for accepting the offer letter.';
            // return view('customer.offer-accepted', compact('message'));
           
        }else{
            
           Session::flash('errorMessage', "Error. Invalid Code");
           return back();
        }
            

        } catch (Exception $e) {
          
             return redirect('/');
        }
        
    }
}
