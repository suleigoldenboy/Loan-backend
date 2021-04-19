<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;

class AccountsChart extends Model
{
    protected $table = "accounts_charts";
    protected $guarded = ['id'];
    public $timestamps = false;


    public function children()
    {
        return $this->hasMany('App\Models\Account\SubAccountsChart', 'primary_account_id')->where('sub_account_type','primary');
    }
    public function childrenCr()
    {
        return $this->hasMany('App\Models\Account\SubAccountsChart', 'primary_account_id')
        ->where('sub_account_type','primary')->where('transaction_type','cr');
    }
    public function childrenDr()
    {
        return $this->hasMany('App\Models\Account\SubAccountsChart', 'primary_account_id')
        ->where('sub_account_type','primary')->where('transaction_type','dr');
    }
    public function balance(){
        return $this->hasMany('App\Models\Account\AccountsSummeryDetail','code','code');
                    //->where('code','code');
    }
}
