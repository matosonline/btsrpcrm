<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadDetail extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'lead_details';
}
