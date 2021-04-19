<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\OfferLetter;
use App\Models\Loan\Product;
use App\Http\Helpers\AdminHelper;
use Auth;
use Exception;
use Session;

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


            return view('admin.settings.offerletter.edit', compact('letter'));

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
