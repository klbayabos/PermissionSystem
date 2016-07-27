<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApprovedDate extends Model
{
    protected $connection = 'mysql';
    protected $table = 'approved_dates';
    protected $dates = ['approved_date'];
    protected $fillable = [
        'request_aid', 'approved_date'
    ];
    public $timestamps = false;
}
