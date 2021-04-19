<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = "branches";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'state'];
    protected $guarded = ['id'];
    // public $timestamps = false;
}
