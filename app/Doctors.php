<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
   
    protected $table = 'doctors';
    use SoftDeletes;
    
}
