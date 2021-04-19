<?php

namespace App\Http\Controllers\Api\Customer;

use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;
use App\User\Verification\CustomerVerification;
use App\Http\Requests\Api\Customer\FileManagerRequest;
use Exception;

class FileManager extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function addFile(FileManagerRequest $request, CustomerVerification $customer)
    {
        $customer->create(array_merge(
            $this->appendData($request), $request->all()
        ));
        return jsonResponse(['data' => user()]);
    }

    public function appendData($request)
    {
        return [
            'given_id_card' => true,
            'given_utility_bill' => true,
            'given_bank_statement' => true,
            'customer_id' => $request->user()->id,
            'documents' => $this->uploadFiles($request),
        ];
    }

    private function uploadFiles($request){
        $documents = [
            'id_cards' => ($request->file('id_cards')) ? $request->file('id_cards'): null,
            'utility' => ($request->file('utility')) ? $request->file('utility'): null,
            'bankStatement' => ($request->file('bankStatement')) ? $request->file('bankStatement'): null,
        ];
        $uploaded =[];
        foreach ($documents as $key => $document) {
            if (!empty($document)) {
                try{
                    $fileName = uniqid().time().'.'.$document->getClientOriginalExtension();
                    $file = base64_encode($document);
                    try {
                        $document->move(public_path('customer/verification/documents'), $fileName);
                    } catch (\Throwable $th) {
                        throw $th->getMessage();
                    }
                    array_push($uploaded, [
                        $key => [
                            'name' => $fileName,
                            'file' => $file
                        ]
                    ]);
                }catch(Exception $e){
                    return invalidRequest($e->getMessage());
                }
            }
        }
        return (empty($uploaded)) ?  ['no_file' => 'File Not Uploaded'] : $uploaded;
    }
}
