<?php

namespace App\Models\Loan;

use App\User\CustomerLoan\Loan;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $guarded = ['id'];

    public $timestamps = false;

    public function offer_letter()
    {
        return $this->hasOne('App\Models\Admin\OfferLetter','product_id', 'id');
    }
    // public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'interest_rate', 'minimum_principal', 'maximum_principal', 'processing_charge', 'insurance_charge', 'loan_duration', 'loan_duration_length', 'repayment_method', 'interest_method', 'late_repayment_penalty_amount', 'early_repayment_charge','after_maturity_date_penalty_amount', 'status'];

    public function loan()
    {
        return $this->hasMany(Loan::class, 'product_id', 'id');
    }
    public function find($id):Object{
        return $this->where('id', $id)->first();
    }
}

