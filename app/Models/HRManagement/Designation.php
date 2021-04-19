<?php

namespace App\Models\HRManagement;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'state'];

    
}
