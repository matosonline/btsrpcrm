<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorsAgent extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'doctors_agent';
}
