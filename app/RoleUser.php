<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    protected $table = 'role_user';
}
