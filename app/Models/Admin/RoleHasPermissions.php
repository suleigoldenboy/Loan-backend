<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class RoleHasPermissions extends Model
{
    protected $table = "role_has_permissions";
    protected $guarded = ['id'];
    public $timestamps = false;
}
