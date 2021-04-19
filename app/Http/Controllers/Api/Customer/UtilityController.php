<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Admin\Branch;
use App\Models\Loan\Product;
use App\System\BankList;
use Illuminate\Http\Request;

class UtilityController extends Controller
{

    public function getBranch(Request $request)
    {
        try {
            return jsonResponse(['branches' => Branch::get()]);
        } catch (\Throwable $th) {
            return jsonResponse(['message' => $th->getMessage()]);
        }
    }

    public function getBankList(Request $request){
        try {
            return jsonResponse(['banks' => BankList::get()]);
        } catch (\Throwable $th) {
            return jsonResponse(['message' => $th->getMessage()]);
        }
    }

    public function getProducts(Request $request){
        try {
            return jsonResponse(['products' => Product::get()]);
        } catch (\Throwable $th) {
            return jsonResponse(['message' => $th->getMessage()]);
        }
    }
}
