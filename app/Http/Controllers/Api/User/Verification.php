<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class Verification extends Controller
{
    public function VerifyBvn(Request $request)
    {
        $request->validate([
            'bvn_number' => 'required|integer|min:10|max:15'
        ]);
        try{
            $request->user()->VerifyBvn($request->bvn_number);
        }catch(Exception $e){
            return jsonResponse(['message' => $e->getMessage()], 400);
        }
    }

    public function verifyCard(Request $request)
    {
        $request->validate([
            'bin' => 'required'
        ]);
        try {
            $request->user()->VerifyCard($request->bin);
        } catch (\Throwable $th) {
            return jsonResponse(['message' => $th->getMessage()], 400);
        }
    }

    public function verifyAccount(Request $request)
    {
        $request->validate([
            'account_number' => 'required'
        ]);
        try {
            $request->user()->ValidateAccount($request->account_number);
        } catch (\Throwable $th) {
            return jsonResponse(['message' => $th->getMessage()], 400);
        }
    }
}
