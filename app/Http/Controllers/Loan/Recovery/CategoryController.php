<?php

namespace App\Http\Controllers\Loan\Recovery;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Loan\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Get Performing Loan
     * @param  Object Illuminate\Http\Request
     * @return Object Illuminate\Http\Response
    */
    public function getPerformingLoan(Request $request)
    {
        DB::table('loans')->select('release_date')->where('release_date' );
        $this->getRowByDateDiff('release_date', 30);
        $performingLoan = Loan::whereDate('release_date', '<', Carbon::now()->subMonth())->get();
        return view('admin.loan.recovery.categories', ['loans' => $performingLoan]);
    }

    public function getRowByDateDiff($field, $days){
        Loan::select(DB::raw("SELECT * FROM `loans` WHERE {$field} > DATE_ADD(NOW(),INTERVAL -$days DAY)"))->get();
    }
}
