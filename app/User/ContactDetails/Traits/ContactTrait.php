<?php
namespace App\User\ContactDetails\Traits;

/**
 * Contact Trait and Properties
 */
trait ContactTraits
{
    
    public function customer()
    {
        return $this->belongsTo('App\User\Customer');
    }
    
}
