<?php

namespace App\Models\Customer;

use App\User\Customer\Customer;
use Illuminate\Database\Eloquent\Model;

class CustomerEmployment extends Model
{
    protected $table = "customer_income_details";
    protected $guarded = ['id'];
    // public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bvn','income','employment_status','business_name','business_state','business_city','business_lga','business_address','business_phone_number','rc_bn','beneficiary_bank','account_name','account_number','monthly_turn_over','monthly_profit','date_of_inc_reg','employers_name','joined_date','monthly_gross_salary','monthly_net_pay','salary_account_number','salary_bank_name','salary_account_name','salary_pay_day','employer_phone_number','employer_email','name_of_institution_retired_from','retired_start_date','retired_end_date','pension_paying_institute','pension_number','monnthly_pension_amount','pension_bank','student_name','school_name','school_address','current_level','name_of_department','parent_full_name','parent_address','iips','parents_phone_number','parent_bank_name','parent_account_number','parent_account_name',
        'customer_id'
    ];

    public function user()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
