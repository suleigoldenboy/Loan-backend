<?php

namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;

class TheLoanOfferLetter extends Model
{
    protected $table = "loan_offer_letter";
    protected $guarded = ['id'];
    public $timestamps = false;
}
