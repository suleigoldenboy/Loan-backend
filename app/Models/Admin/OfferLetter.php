<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class OfferLetter extends Model
{
    protected $table = "offer_letters";
    protected $guarded = ['id'];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo('App\Models\Loan\Product', 'product_id', 'id');
    }
}
