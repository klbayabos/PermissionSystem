<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestApplication extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'request_id';
    protected $dates = ['starting_date','end_date'];
    protected $table = 'request';
    protected $fillable = [
        'id','type','process_id','team_id','starting_date','end_date','starting_time','end_time','request_purpose','status'
    ];
}
